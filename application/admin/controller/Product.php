<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;

class Product extends AdminBase {

    public function del() {
        $proid = input('post.id');
        return model('product')->delProByID($proid);
    }

    public function productlist() {
        $productlist = model('product')->getProList();
        $this->assign('productlist', $productlist);
        return $this->fetch();
    }

    public function edit() {
        $id  = input('param.id');
        $pro = model('product')->where('id', $id)->find();
        $this->assign('product', $pro);
        return $this->fetch();
    }

    public function add() {
        return $this->fetch();
    }

    public function doAdd() {

    }
}