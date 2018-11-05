<?php

namespace app\index\model;
use app\common\model\Common;

class Address extends Common {

    public function getAddr($userid, $status) {
        return $this->where('userid', $userid)
            ->where('status', $status)
            ->order('id desc')
            ->find();
    }
}