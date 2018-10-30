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
    //获取下线人数
    public function clientNum($id) {
        $clientNum = 0;
        $client1   = $this->where('pid', $id)->select();
        foreach ($client1 as $value) {
            $client2 = $this->where('pid', $value['id'])->select();
            $clientNum++;
            foreach ($client2 as $v) {
                $clientNum++;
            }
        }
        return $clientNum;
    }
    //获取地址
    public function getAddr() {
        return $this->hasMany('address', 'userid');
    }
    //获取购物车
    public function getCart() {
        return $this->hasMany('cart', 'userid');
    }

    //查询代理商两级下线
    public function getClient($id) {
        $clients[] = $this->where('pid', $id)->select();
        foreach ($clients[0] as $value) {
            $clients[] = $this->where('pid', $value['id'])->select();
        }
        return $clients;
    }

}