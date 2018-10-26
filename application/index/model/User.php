<?php

namespace app\index\model;
use think\Model;

/**
 * 用户表模型
 */
class User extends Model {
    //开启时间字段自动写入
    protected $autoWriteTimestamp = true;
    protected $createTime         = 'createtime';
    protected $updateTime         = false;

    //注册密码自动加密
    public function setPasswordAttr($password) {
        return md5($password);
    }

    //登录验证
    public function checkLogin($userInfo) {
        return $this->where('mobile', 'eq', $userInfo['mobile'])
            ->where('password', 'eq', md5($userInfo['password']))
            ->find();
    }

    public function clientNum($id) {
        return $this->where('pid', $id)->count();
    }

    public function getAddr() {
        return $this->hasMany('address', 'userid');
    }

    public function getCart() {
        return $this->hasMany('cart', 'userid');
    }
}