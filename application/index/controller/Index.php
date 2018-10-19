<?php
namespace app\index\controller;
use app\common\controller\IndexBase;

class Index extends IndexBase {

    public function index() {
        return $this->fetch();
    }

    public function help() {
        return $this->fetch();
    }
}
