<?php

namespace app\index\model;
use app\common\model\Common;

class Cart extends Common {
    public function getProduct() {
        return $this->hasOne('product', 'id', 'productid');
    }
}