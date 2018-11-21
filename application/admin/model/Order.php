<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 11:41
 */
namespace app\admin\model;
use app\common\model\Common;
Class Order extends Common{
    public function getOrderList($page){
        $listData = [];
        $listData['order'] = $this->where('uid','neq','null')->paginate($page);
        $listData['count'] = $this->where('uid','neq','null')->count();
        return $listData;
    }

    public function getOrderListByStatus($page,$status){
        $listData = [];
        $listData['order'] = $this->where('uid','neq','null')
            ->where('status',$status)
            ->paginate($page);
        $listData['count'] = $this->where('uid','neq','null')
            ->where('status',$status)
            ->count();
        return $listData;
    }

    public function  getUser(){
        return $this->hasOne('user','id','uid');
    }

    public function getAddress(){
        return $this->hasOne('address','id','addr_id');
    }
}