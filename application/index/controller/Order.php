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

        $order['totalprice'] = $data['totalprice'];
        $order['num']        = $data['num'];
        $this->assign('order', $order);
        return $this->fetch();
    }
}
