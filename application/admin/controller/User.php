<?php

namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Validate;

class User extends AdminBase {

    public function login() {
        return $this->fetch();
    }
    public function doLogin() {
        $data  = input('post.');
        $rules = [
            'nickname|昵称' => 'length:2,100|token',
            'password|密码' => 'length:6,100',
        ];
        $validate = new Validate($rules);
        if ($validate->check($data)) {
            $admin = model('user')->getAdmin($data);
            if ($admin && $admin['usertype'] > 7) {
                session('adminInfo', $admin);
                session('successMsg', 'Welcome! ' . $admin['nickname']);
                $this->redirect('index/index');
            } elseif ($admin) {
                session('errorMsg', '您的权限不足!');
                $this->redirect('user/login');
            } else {
                session('errorMsg', '用户名或密码错误!');
                $this->redirect('user/login');
            }
        } else {
            session('errorMsg', $validate->getError());
            $this->redirect('user/login');
        }
    }

    public function logout() {
        session('adminInfo', null);
        session('successMsg', '退出成功!');
        $this->redirect('user/login');
    }

    public function userlist() {
        $userlist = model('user')->getUserlist();
        $this->assign('userlist', $userlist);
        return $this->fetch();
    }
}