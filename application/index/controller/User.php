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

    public function cart() {
        return $this->fetch();
    }

    public function login() {
        return $this->fetch();
    }

    public function doLogin() {
        $data  = input('post.');
        $rules = [
            'mobile|手机号'  => ['require', 'regex' => '/^1(3\d|4[57]|5[0-37-9]|66|7[367]|8[0235-9]|99)\d{8}$/', 'token', 'unique:user'],
            'password|密码' => 'require|length:6,100',
        ];
        $validate = new Validate($rules);
        if ($validate->check($data)) {
            $userInfo = model('user')->checkLogin($data);
            if ($userInfo) {
                session("userInfo", $userInfo);
            }
        }

        if (session('userInfo')) {
            session('successMsg', '登录成功!');
            $this->redirect('index/index');
        } else {
            session('errorMsg', '账号或者密码错误!');
            $this->redirect('user/login');
        }
    }

    public function register() {
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
            $this->redirect('index/index') : session('errorMsg', '注册失败!') &&
            $this->redirect('user/register');
        } else {
            session('errorMsg', $validate->getError());
            $this->redirect('user/register');
        }
    }

    public function logout() {
        session('userInfo', null);
        session('successMsg', '退出成功!');
        $this->redirect('index/index');
    }
}