<?php
namespace app\admin\model;
use app\common\model\Common;

class Productimg extends Common {
    public function getImg($id, $type = null) {
        return $type ? $this->where('productid', $id)->where('type', $type)->select() : $this->where('productid', $id)->select();
    }

    public function delImgByID($id) {
        return $this->where('id', $id)->delete();
    }

}