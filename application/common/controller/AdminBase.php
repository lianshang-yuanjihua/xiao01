<?php

namespace app\common\controller;
use think\Controller;

/**
 * 后台页面父类
 */

class AdminBase extends Controller {

    protected $beforeActionList = [
        'checklogin' => ['only' => 'index,welcome'],
    ];

    public function checklogin() {
        if (!session('adminInfo')) {
            session('errorMsg', '请先登录~');
            $this->redirect('user/login');
        }
    }

    public function _initialize() {
        // echo "后台控制器初始化";

    }

}
