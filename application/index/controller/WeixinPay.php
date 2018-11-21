<?php
namespace app\index\controller;
use think\Controller;
use think\Exception;

class WeixinPay extends Controller{
    public function notify(){
        try{
            $notify = new \wxpay\Notify();
            $notify->Handle();
        }catch (Exception $e){
            file_put_contents(RUNTIME_PATH.'/log/info.txt',$e,FILE_APPEND);
        }

    }
}