<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Order extends IndexBase {
    public function createOrder() {
        $data          = input('post.');
        $order         = [];
        $id = session('userInfo.id');
        $user = model('user')->where('id',$id)->find();
        session('userInfo',$user);
        $order['addr'] = model('address')->getAddr(session('userInfo.id'), 1);
        if (empty($order['addr'])) {
            $order['addr'] = model('address')->getAddr(session('userInfo.id'), 0);
        }
        $order['product'] = model('product')->getProductByID(implode(',', $data['id']), 'in');
        $order['totalprice'] = $data['totalprice'];
        $order['num']        = $data['num'];

        $this->assign('order', $order);
        return $this->fetch();
    }

    public function order() {
        $user = session('userInfo');
        $tmp                   = input('post.data');
        $data                  = json_decode($tmp, true);
        $order                 = [];
        $order['uid']          = session('userInfo.id');
        $order['addr_id']      = $data['addrid'];

        $order['out_trade_on'] = date('YmdHis') . rand(1000, 9999);
        $voucher = $data['voucher'];
        if ($voucher==1 && $user->voucher==500){
            $order['endprice']     = $data['endprice'] - $user->voucher;
            model('user')->where('id',$user->id)->update(['voucher'=>0]);
            $user->voucher = 0;
            session('userInfo',$user);
        } else {
            $order['endprice']     = $data['endprice'];
        }
        $order['created'] = time();
        $id                    = model('order')->insertGetId($order);
        if ($id) {
            $orderPro = [];
            $proid    = $data['proid'];
            $pronum   = $data['pronum'];
            $suit    = $data['suit'];
            $price    = $data['proprice'];
            for ($i = 0; $i < count($proid); $i++) {
                $orderPro[$i]['oid']    = $id;
                $orderPro[$i]['proid']  = $proid[$i];
                $orderPro[$i]['pronum'] = $pronum[$i];
                $proprice               = 0;
                if ($pronum[$i] >= 10) {
                    $proprice = floor($pronum[$i] / 10) * $suit[$i];
                    $proprice += $pronum[$i] % 10 * $price[$i];
                } else {
                    $proprice = $pronum[$i] % 10 * $price[$i];
                }
                $orderPro[$i]['proprice'] = $proprice;
            }
            $res = model('orderproducts')->insertAll($orderPro);
            if ($res) {
                model('cart')->where('userid',$user->id)->delete();
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
        $params['body'] = '源动力';
        // $params['total_fee']    = $order['endprice'] * 100;
        $params['total_fee']    = 1;
        $params['out_trade_on'] = $order['out_trade_on'];
        $jsApiParameters        = \wxpay\JsapiPay::getPayParams($params);
        return $jsApiParameters;
    }

}
