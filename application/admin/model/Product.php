<?php
namespace app\admin\model;
use app\common\model\Common;

class Product extends Common {

    public function getProList() {
        $prolist            = [];
        $prolist['prolist'] = $this->where('status', 'neq', 0)
            ->order('id desc')
            ->paginate(5);
        $prolist['procount'] = $this
            ->where('status', 'neq', 0)
            ->count();
        return $prolist;
    }

    public function getProduct($id) {
        return $this->where('id', $id)->find();
    }

    public function getImg() {
        return $this->hasMany('Productimg', 'productid');
    }

    public function delProByID($id) {
        return $this->where('id', $id)->update(['status' => 0]);
    }
}