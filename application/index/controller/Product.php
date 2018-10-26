<?php

namespace app\index\controller;
use app\common\controller\IndexBase;

class Product extends IndexBase {
    public function detail() {
        return $this->fetch();
    }
}