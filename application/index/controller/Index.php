<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Index extends IndexBase {

    public function index() {
        $data = model('product')->getProduct(2);
        if (empty($data)) {
            echo "<h1>没有商品<h1>";die;
        }
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

    public function test1(){
        $path = '--a--';
        $path = trim($path ,'--');
        print_r(explode('--',$path));
    }
}
