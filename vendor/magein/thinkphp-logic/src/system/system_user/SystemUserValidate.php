<?php

namespace magein\thinkphp_logic\system\system_user;

use think\Validate;

class SystemUserValidate extends Validate
{
    protected $rule = [
        'username' => 'require|length:1,40',
        'password' => 'alphaDash|length:6,18',
        'nickname' => 'require|length:1,255',
        'phone' => 'require|number|unique:system_user|length:11',
        'email' => 'email|length:1,255',
        'sex' => 'integer|in:0,1,2',
        'status' => 'integer|in:0,1',
    ];

    protected $message = [
        'username.require' => '请输入登录账号',
        'username.length' => '登录账号长度不正确,允许的长度1~40',
        'password.alphaDash' => '登录密码值为字母、数字、下划线的组合',
        'password.length' => '登录密码长度不正确,允许的长度1~60',
        'nickname.require' => '请输入用户昵称',
        'nickname.length' => '用户昵称长度不正确,允许的长度1~255',
        'phone.require' => '请输入手机号码',
        'phone.number' => '手机号码格式错误',
        'phone.unique' => '手机号码已经被使用',
        'phone.length' => '手机号码长度不正确,允许的长度1~11',
        'email.email' => '邮箱地址格式错误',
        'email.length' => '邮箱地址长度不正确,允许的长度1~255',
        'sex.integer' => '性别格式错误',
        'sex.in' => '性别可选值错误',
        'status.integer' => '状态格式错误',
        'status.in' => '状态可选值错误',
    ];
}