<?php
namespace app\admin\model;
use app\common\model\Common;

class Productimg extends Common {
    public function getImg($id) {
        return $this->where('productid', $id)->select();
    }

    public function delImgByID($id) {
        return $this->where('id', $id)->delete();
    }
}