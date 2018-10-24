<?php

namespace app\index\model;
use app\common\model\Common;

class Product extends Common {

    public function getImg() {
        return $this->hasMany('Productimg', 'productid');
    }

    public function getProduct() {
        return $this->where('status', 1)->find();
    }
}