<?php
namespace app\admin\model;
use app\common\model\Common;

class Product extends Common {

    public function getProList() {
        $prolist            = [];
        $prolist['prolist'] = $this->order('id desc')
            ->paginate(5);
        $prolist['procount'] = $this->count();
        return $prolist;
    }

}