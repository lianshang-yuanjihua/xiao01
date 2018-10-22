<?php

namespace app\admin\model;
use app\common\model\Common;

class User extends Common {

    //开启时间字段自动写入
    protected $autoWriteTimestamp = true;
    protected $createTime         = 'createtime';
    protected $updateTime         = false;
    //获取匹配的管理员
    public function getAdmin($data) {
        return $this->where('nickname', $data['nickname'])
            ->where('password', md5($data['password']))
            ->where('usertype', 'gt', 7)
            ->find();
    }

    public function getUserlist() {
        $listData             = [];
        $listData['userlist'] = $this->where('usertype', 'lt', 8)
            ->where('usertype', 'neq', 3)
            ->order('id desc')
            ->paginate(5);
        $listData['userCount'] = $this->where('usertype', 'lt', 8)
            ->where('usertype', 'neq', 3)
            ->count();
        return $listData;
    }

    public function delUserByID($id) {
        return $this->where('id', 'IN', $id)->update(['usertype' => 3]);
    }

    public function getDelusers() {
        $listData             = [];
        $listData['userlist'] = $this->where('usertype', 'eq', 3)
            ->order('id desc')
            ->paginate(5);
        $listData['userCount'] = $this->where('usertype', 'eq', 3)
            ->count();
        return $listData;
    }

}