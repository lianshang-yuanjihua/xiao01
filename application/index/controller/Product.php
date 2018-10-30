<?php

namespace app\index\controller;
use app\common\controller\IndexBase;

class Product extends IndexBase {
    public function detail() {
        $id             = input('param.id');
        $product        = model('product')->getProductByID($id);
        $img            = [];
        $img['showimg'] = model('productimg')->getImg($id, 2);
        $img['detimg']  = model('productimg')->getImg($id, 3);
        $this->assign([
            'product' => $product,
            'img'     => $img,
        ]);
        return $this->fetch();
    }
}