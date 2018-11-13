<?php
namespace app\admin\controller;
use app\common\controller\AdminBase;
use think\Validate;

class User extends AdminBase {

    //返回登录页面
    public function login() {
        return $this->fetch();
    }

    //执行登录检测
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
    //退出登录
    public function logout() {
        session('adminInfo', null);
        session('successMsg', '退出成功!');
        $this->redirect('user/login');
    }
    //用户列表
    public function userlist() {
        $userlist = model('user')->getUserlist();
        $this->assign('userlist', $userlist);
        return $this->fetch();
    }
    public function edit() {

    }

    //后台删除用户
    public function del() {
        $userid = input('post.id');
        return model('user')->delUserByID($userid);
    }
    //后台查找用户
    public function search() {
        $search = input('param.keywords');
        $type   = input('param.del');
        $users  = [];
        if (!$type) {
            $users['userlist'] = model('user')->where('mobile', 'like', '%' . $search . '%')
                ->where('usertype', 'neq', 3)
                ->where('usertype', 'lt', 8)
                ->paginate(5, false, ['query' => request()->param()])->each(function ($value, $key) use ($search) {
                $value->mobile = str_replace($search, '<b style="color:#009688">' . $search . '</b>', $value->mobile);
            });
            $users['userCount'] = model('user')->where('mobile', 'like', '%' . $search . '%')
                ->where('usertype', 'lt', 8)
                ->where('usertype', 'neq', 3)
                ->count();
        } else {
            $users['userlist'] = model('user')->where('mobile', 'like', '%' . $search . '%')
                ->where('usertype', 'eq', 3)
                ->paginate(5, false, ['query' => request()->param()])->each(function ($value, $key) use ($search) {
                $value->mobile = str_replace($search, '<b style="color:#009688">' . $search . '</b>', $value->mobile);
            });
            $users['userCount'] = model('user')->where('mobile', 'like', '%' . $search . '%')
                ->where('usertype', 'eq', 3)
                ->count();
        }

        $this->assign('keywords', $search);
        $this->assign('userlist', $users);
        return $this->fetch('userlist');
    }

    public function delusers() {
        $users = model('user')->getDelusers();
        $this->assign('delusers', $users);
        return $this->fetch();
    }

}