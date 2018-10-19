<?php

namespace app\admin\model;
use think\Model;

class User extends Model {

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
            ->order('createtime desc')
            ->paginate(20);
        $listData['userCount'] = $this->where('usertype', 'lt', 8)->count();

        return $listData;
    }
}