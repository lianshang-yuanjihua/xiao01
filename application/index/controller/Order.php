<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Order extends IndexBase {
    public function createOrder() {
        $data          = input('post.');
        $order         = [];
        $pro           = [];
        $order['addr'] = model('address')->getDefaultAddr(session('userInfo.id'));
        foreach ($data as $key => $value) {
            switch ($key) {
            case 'shop':
                foreach ($value as $k => $v) {
                    $pro[$v['number']] = model('product')->getProductByID($v['id']);
                }
                $order['pro'] = $pro;
                break;
            case 'totalPrice':
                $order['total'] = $value;
                break;
            }
        }
        $this->assign('order', $order);
        return $this->fetch();
    }
}
