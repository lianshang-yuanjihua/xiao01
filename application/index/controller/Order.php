<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Order extends IndexBase {
    public function createOrder() {
        $data          = input('post.');
        $order         = [];
        $pro           = [];
        $order['addr'] = model('address')->getAddr(session('userInfo.id'), 1);
        if (empty($order['addr'])) {
            $order['addr'] = model('address')->getAddr(session('userInfo.id'), 0);
        }
        $order['product'] = model('product')->getProductByID(implode(',', $data['id']), 'in');
        // echo "<pre>";
        // print_r(implode(',', $data['id']));
        // print_r($data);
        // print_r($order['product']);die;
        $order['totalprice'] = $data['totalprice'];
        $order['num']        = $data['num'];
        $this->assign('order', $order);
        return $this->fetch();
    }

    public function order() {
        $tmp                   = input('post.data');
        $data                  = json_decode($tmp, true);
        $order                 = [];
        $order['uid']          = session('userInfo.id');
        $order['addr_id']      = $data['addrid'];
        $order['endprice']     = $data['endprice'];
        $order['out_trade_on'] = date('YmdHis') . rand(1000, 9999);
        $id                    = model('order')->insertGetId($order);
        if ($id) {
            $orderPro = [];
            $proid    = $data['proid'];
            $pronum   = $data['pronum'];
            $offer    = $data['offer'];
            $price    = $data['proprice'];
            for ($i = 0; $i < count($proid); $i++) {
                $orderPro[$i]['oid']    = $id;
                $orderPro[$i]['proid']  = $proid[$i];
                $orderPro[$i]['pronum'] = $pronum[$i];
                $proprice               = 0;
                if ($pronum[$i] >= 10) {
                    $proprice = floor($pronum[$i] / 10) * $offer[$i];
                    $proprice += $pronum[$i] % 10 * $price[$i];
                } else {
                    $proprice = $pronum[$i] % 10 * $price[$i];
                }
                $orderPro[$i]['proprice'] = $proprice;
            }
            $res = model('orderproducts')->insertAll($orderPro);
            if ($res) {
                return ['total_fee' => $order['endprice'], 'id' => $id];
            }
            return false;
        } else {
            return false;
        }
    }
    public function pay() {
        $id             = input('post.id');
        $order          = model('order')->where('id', $id)->find();
        $params         = [];
        $params['body'] = ' 源动力';
        // $params['total_fee']    = $order['endprice'];
        $params['total_fee']    = 1;
        $params['out_trade_on'] = $order['out_trade_on'];
        $jsApiParameters        = \wxpay\JsapiPay::getPayParams($params);
        return $jsApiParameters;
    }
}
