<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Index extends IndexBase {

    public function index() {
        $data = model('product')->getProduct();
        $this->assign('product', $data);
        return $this->fetch();
    }

    public function help() {
        return $this->fetch();
    }
}
