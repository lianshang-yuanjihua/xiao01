<?php

namespace app\index\model;
use app\common\model\Common;

class Cart extends Common {
    public function getProduct() {
        return $this->hasOne('product', 'id', 'productid');
    }

    public function getCartNum($id) {
        return $this->where('userid', $id)->count();
    }

    public function delByID($id) {
        return $this->where('id', $id)->delete();
    }

}