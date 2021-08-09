<?php

namespace magein\thinkphp_logic\member;

use think\Validate;

class MemberValidate extends Validate
{
    protected $rule = [
        'username' => 'require|length:1,255',
        'password' => 'require|alphaDash|length:6,18',
        'confirm' => 'require|confirm:password',
        'phone' => 'require|number|unique:member|length:11',
        'nickname' => 'length:1,255',
        'email' => 'email|length:1,255',
        'sex' => 'integer|in:0,1,2',
        'age' => 'integer',
        'money' => 'float',
        'balance' => 'float',
        'province_id' => 'integer',
        'city_id' => 'integer',
        'area_id' => 'integer',
        'address' => 'length:1,255',
    ];

    protected $message = [
        'username.require' => '请输入登录账号',
        'username.length' => '登录账号长度不正确,允许的长度1~255',
        'password.require' => '请输入密码',
        'password.alphaDash' => '密码值为字母、数字、下划线的组合',
        'password.length' => '密码长度不正确,允许的长度1~255',
        'confirm.require' => '请输入密码',
        'confirm.confirm' => '密码密码跟确认密码不一致',
        'phone.require' => '请输入手机号码',
        'phone.number' => '手机号码格式错误',
        'phone.unique' => '手机号码已经被使用',
        'phone.length' => '手机号码长度不正确,允许的长度1~255',
        'nickname.length' => '昵称长度不正确,允许的长度1~255',
        'email.email' => '邮箱地址格式错误',
        'email.length' => '邮箱地址长度不正确,允许的长度1~255',
        'sex.integer' => '性别格式错误',
        'sex.in' => '性别可选值错误',
        'age.integer' => '年龄格式错误',
        'money.float' => '总消费金额格式错误',
        'balance.float' => '余额格式错误',
        'province_id.integer' => '省格式错误',
        'city_id.integer' => '市格式错误',
        'area_id.integer' => '县格式错误',
        'address.length' => '所在地长度不正确,允许的长度1~255',
    ];
}