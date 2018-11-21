<?php

namespace app\common\model;

use think\Model;

class Common extends Model {
    protected $autoWriteTimestamp = true;
    protected $createTime = 'created';
    protected $updateTime = false;
}