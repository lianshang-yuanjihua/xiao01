<?php

namespace app\index\controller;
use app\common\controller\IndexBase;

class Cart extends IndexBase {

    public function add() {
        $data            = input('post.');
        $data['userid']  = session('userInfo.id');
        $data['created'] = time();
        $res             = model('cart')
            ->where('userid', $data['userid'])
            ->where('productid', $data['productid'])->setInc('num');
        if ($res) {
            echo "0";
        } else {
            if (model('cart')->save($data)) {
                echo '1';
            } else {
                echo "2";
            }
        }
    }

    public function del() {
        $id = input('param.id');
        return model('cart')->delByID($id);
    }
}