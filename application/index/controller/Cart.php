<?php

namespace app\index\controller;
use app\common\controller\IndexBase;

class Cart extends IndexBase {

    public function add() {
        $data            = input('post.');
        $data['userid']  = session('userInfo.id');
        $data['created'] = time();
        $res             = null;
        if ($data['buynum']) {
            $res = model('cart')->save($data);
        }
        if ($res) {
            echo "1";
        } else {
            echo '0';
        }
    }
}