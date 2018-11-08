<?php
namespace app\index\controller;
use think\Controller;
class WeixinPay extends Controller{
    public function notify(){
        $notify = new \wxpay\Notify();
        $notify->Handle();
    }
}