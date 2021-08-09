<?php

namespace magein\thinkphp_logic\system\system_user_role;

use think\Validate;

class SystemUserRoleValidate extends Validate
{
    protected $rule = [
        'title' => 'require|length:1,30',
        'desc' => 'require|length:1,255',
        'auth' => 'length:1,1500',
    ];

    protected $message = [
        'title.require' => '请输入角色名称',
        'title.length' => '角色名称长度不正确,允许的长度1~30',
        'desc.require' => '请输入角色描述',
        'desc.length' => '角色描述长度不正确,允许的长度1~255',
        'auth.length' => '角色权限长度不正确,允许的长度1~1500',
    ];
}