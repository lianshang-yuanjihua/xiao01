<?php

namespace app\index\model;
use app\common\model\Common;

class Address extends Common {

    public function getDefaultAddr($userid) {
        return $this->where('userid', $userid)->where('status', 1)->order('id desc')->find();
    }
}