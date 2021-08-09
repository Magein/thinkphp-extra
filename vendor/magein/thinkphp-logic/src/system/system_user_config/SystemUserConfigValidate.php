<?php

namespace magein\thinkphp_logic\system\system_user_config;

use think\Validate;

class SystemUserConfigValidate extends Validate
{
    protected $rule = [
        'user_id' => 'require|integer',
        'role' => 'length:1,3000',
        'auth' => 'length:1,3000',
        'layout' => 'length:1,3000',
    ];

    protected $message = [
        'user_id.require' => '请输入用户ID',
        'user_id.integer' => '用户ID格式错误',
        'role.length' => '角色长度不正确,允许的长度1~3000',
        'auth.length' => '权限长度不正确,允许的长度1~3000',
        'layout.length' => '布局长度不正确,允许的长度1~3000',
    ];
}