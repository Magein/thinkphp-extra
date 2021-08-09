<?php

namespace magein\thinkphp_logic\system\system_user_action;

use think\Validate;

class SystemUserActionValidate extends Validate
{
    protected $rule = [
        'user_id' => 'require|integer',
        'controller' => 'require|length:1,255',
        'action' => 'require|length:1,255',
        'ip' => 'require|length:1,255',
        'params' => 'length:1,3000',
    ];

    protected $message = [
        'user_id.require' => '请输入用户ID',
        'user_id.integer' => '用户ID格式错误',
        'controller.require' => '请输入控制器',
        'controller.length' => '控制器长度不正确,允许的长度1~255',
        'action.require' => '请输入行为',
        'action.length' => '行为长度不正确,允许的长度1~255',
        'ip.require' => '请输入ip地址',
        'ip.length' => 'ip地址长度不正确,允许的长度1~255',
        'params.length' => '参数长度不正确,允许的长度1~3000',
    ];
}