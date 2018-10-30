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

    public function getProduct($type, $comp = '') {
        if (!$comp) {
            return $this->where('status', $type)->find();
        } else {
            return $this->where('status', $comp, $type)->find();
        }
    }

    public function getProductByID($id) {
        return $this->where('id', $id)->find();
    }
}