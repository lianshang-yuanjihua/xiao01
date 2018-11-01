<?php
namespace app\common\controller;

use think\Controller;

/**
 * 前台页面的父类
 */
class IndexBase extends Controller {

    protected $beforeActionList = [
        'checklogin' => ['only' => 'logout,usercenter,cart'],
    ];

    public function checklogin() {
        if (!session('userInfo')) {
            session('errorMsg', '请先登录~');
            $this->redirect('user/login');
        }
    }

    public function _initialize() {
    }
}