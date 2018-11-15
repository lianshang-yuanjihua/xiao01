<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 10:23
 */
namespace app\admin\controller;
use app\common\controller\AdminBase;
class Order extends AdminBase{

    public function orderList(){
        $listDAta = model('order')->getOrderList(10);
        $orderType =[0=>'未付款',1=>'已付款',2=>'已完成'];
        $this->assign(['listData'=>$listDAta,'orderType'=>$orderType]);
        return $this->fetch();
    }
    public function search(){
        $keyword = input('param.keyword');
        $orderDAta = [];
        $orderDAta['order'] = model('order')
            ->where('out_trade_on','like','%'. $keyword .'%')
            ->where('uid','neq','null')
            ->paginate(5,false,['query'=>request()->param()])
            ->each(function ($value) use ($keyword){
                $value->out_trade_on = str_replace($keyword, '<b style="color:#009688">' . $keyword . '</b>', $value->out_trade_on);
            });
        $orderDAta['count'] = model('order')
            ->where('out_trade_on','like','%'. $keyword .'%')
            ->where('uid','neq','null')
            ->count();
        $orderType =[0=>'未付款',1=>'已付款',2=>'已完成'];
        $this->assign(['listData'=>$orderDAta,'orderType'=>$orderType,'keyword'=>$keyword]);
        return $this->fetch('order_list');
    }
}