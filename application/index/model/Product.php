<?php

namespace app\index\model;
use app\common\model\Common;

class Product extends Common {

    public function getImg() {
        return $this->hasMany('productimg', 'productid');
    }

    public function getImgs() {
        return $this->hasMany('productimg', 'productid');
    }

    public function getProduct() {
        return $this->where('status', 2)->find();
    }
}