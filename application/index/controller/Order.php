<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Order extends IndexBase {
    public function createOrder() {
        // $data = input('post.');
        $userid = session('userInfo.id');
        $data   = [];
        $pro    = [];
        for ($i = 0; $i < 3; $i++) {
            $pro['id']     = $i;
            $pro['number'] = $i;
            $data[$i]      = $pro;
        }

        foreach ($data as $key => $value) {

        }
    }
}
