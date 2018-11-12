<?php
namespace app\common\controller;

use think\Controller;

/**
 * 前台页面的父类
 */
class IndexBase extends Controller {

    protected $beforeActionList = [
        'checklogin' => ['only' => 'logout,usercenter,cart'],
//        'position'=>['only' =>'createOrder']
    ];
    protected $beforeUrl = '';


    public function checklogin() {
        if (!session('userInfo')) {
            $this->position();
            session('errorMsg', '请先登录~');
            $this->redirect('user/login');
        }
    }

    function position($url=''){
        $url = $url?:request()->controller() . '/' . request()->action();
        session('beforeurl',$url);
        return $url;
    }

    public function _initialize() {
        session('beforeurl')&&
            $this->beforeUrl =session('beforeurl');


    }
}