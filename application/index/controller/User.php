<?php

namespace app\index\controller;
use app\common\controller\IndexBase;
use think\Validate;

class User extends IndexBase {

    //用户中心
    public function usercenter() {
        $clientNum = model('user')
            ->clientNum(session('userInfo.id'));
        $this->assign('clientNum', $clientNum);
        return $this->fetch();
    }

    //用户购物车
    public function cart() {
        $id    = session('userInfo.id');
        $carts = model('cart')->where('userid', $id)->select();
        $this->assign('carts', $carts);
        return $this->fetch();
    }

    public function login() {
        return $this->fetch();
    }

    public function doLogin() {
        $data  = input('post.');
        $rules = [
            'mobile|手机号'  => ['require', 'token'],
            'password|密码' => 'require|length:6,100',
        ];
        $validate = new Validate($rules);
        if ($validate->check($data)) {
            $userInfo = model('user')->checkLogin($data);
            if ($userInfo) {
                session("userInfo", $userInfo);
            }
        } else {
            session('errorMsg', $validate->getError());
            $this->redirect('user/login');
            return;
        }

        if (session('userInfo')) {
            session('successMsg', '登录成功!');
            $this->redirect('index/index');
            return;
        } else {
            session('errorMsg', '账号或者密码错误!');
            $this->redirect('user/login');
            return;
        }
    }

    public function register() {
        $pid = input('param.pid');
        if ($pid) {
            $this->assign('pid', $pid);
        }
        return $this->fetch();
    }

    public function doRegister() {
        $data     = input('param.');
        $validate = validate('user');

        if ($validate->check($data)) {
            unset($data['repassword']);
            // print_r($data['__token__']);exit;
            unset($data['__token__']);
            $data['createtime'] = time();
            $user               = model('user');
            //查询是否有推荐人
            $references = $user->where('id', $data['pid'])->find();
            if ($references) {
                $data['path'] = $references['path'] . $data['pid'] . '--';
            }
            $res = $user->save($data);

            $res ? session('successMsg', '注册成功!') &&
            $this->redirect('user/login') : session('errorMsg', '注册失败!') &&
            $this->redirect('user/register');
        } else {
            session('errorMsg', $validate->getError());
            $this->redirect('user/register');
        }
    }
    //退出账号
    public function logout() {
        session('userInfo', null);
        session('successMsg', '退出成功!');
        $this->redirect('index/index');
    }
    //设置页面
    public function edit() {
        return $this->fetch();
    }
    //地址列表
    public function addrlist() {
        return $this->fetch();
    }
    //新增地址
    public function newaddr() {
        return $this->fetch();
    }

    //代理商客户列表
    public function clientlist() {
        $id      = session('userInfo.id');
        $clients = model('user')->getClient($id);
        $type    = [
            '',
            '普通用户',
            '代理商',
        ];
        $this->assign(['clients' => $clients, 'type' => $type]);
        return $this->fetch();
    }
}