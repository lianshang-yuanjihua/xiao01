<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Index extends IndexBase {

    public function index() {
        $data            = model('product')->getProduct(2);
        $slideimg        = model('productimg')->getImg($data['id'], 1);
        $cartimg         = model('productimg')->getImg($data['id'], 0);
        $img['slideimg'] = $slideimg;
        $img['cartimg']  = $cartimg;
        $this->assign([
            'product' => $data,
            'img'     => $img,
        ]);
        return $this->fetch();
    }
    public function help() {
        return $this->fetch();
    }
}
