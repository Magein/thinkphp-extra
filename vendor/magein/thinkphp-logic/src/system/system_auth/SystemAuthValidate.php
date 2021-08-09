<?php

namespace magein\thinkphp_logic\system\system_auth;

use think\Validate;

class SystemAuthValidate extends Validate
{
    protected $rule = [
        'title' => 'require|length:1,30',
        'type' => 'length:1,255',
        'path' => 'require|length:1,255',
        'group' => 'require|length:1,255',
    ];

    protected $message = [
        'title.require' => '请输入接口名称',
        'title.length' => '接口名称长度不正确,允许的长度1~30',
        'type.length' => '接口类型长度不正确,允许的长度1~255',
        'path.require' => '请输入接口路径',
        'path.length' => '接口路径长度不正确,允许的长度1~255',
        'group.require' => '请输入接口分组',
        'group.length' => '接口分组长度不正确,允许的长度1~255',
    ];
}