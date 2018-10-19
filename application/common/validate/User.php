<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate {
    protected $rule = [
        'mobile'     => ['require', 'regex' => '/^1(3\d|4[57]|5[0-37-9]|66|7[367]|8[0235-9]|99)\d{8}$/', 'token', 'unique:user'],
        'password'   => ['require', 'regex' => '/^\w{6,30}$/'],
        'repassword' => 'require|confirm:password',
    ];

    protected $message = [
        'mobile.require'     => '请填写手机号',
        'mobile.regex'       => '手机号码格式不正确',
        'mobile.unique'      => '该号码已存在',
        'mobile.token'       => '请勿重复提交',
        'password.require'   => '请填写密码',
        'password.regex'     => '密码长度在6到30位之间并且只能有字母数字下划线',
        'repassword.require' => '请填写确认密码',
        'repassword.confirm' => '确认密码与密码不一致',
    ];
}