<?php

namespace app\index\model;
use app\common\model\Common;

class Productimg extends Common {
    public function getImg($porid, $type) {
        return $this->where('productid', $porid)
            ->where('type', $type)
            ->select();
    }
}