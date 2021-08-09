<?php

namespace magein\thinkphp_logic\system\system_user_login_log;

use think\Validate;

class SystemUserLoginLogValidate extends Validate
{
    protected $rule = [
        'user_id' => 'require|integer',
        'ip' => 'require|length:1,255',
        'agent' => 'require|length:1,255',
        'languages' => 'length:1,255',
        'device' => 'length:1,255',
        'browser' => 'length:1,255',
        'version_browser' => 'length:1,255',
        'platform' => 'length:1,255',
        'version_platform' => 'length:1,255',
        'mobile' => 'integer|between:1,127',
        'robot' => 'length:1,255',
    ];

    protected $message = [
        'user_id.require' => '请输入用户ID',
        'user_id.integer' => '用户ID格式错误',
        'ip.require' => '请输入登录地址',
        'ip.length' => '登录地址长度不正确,允许的长度1~255',
        'agent.require' => '请输入登录标识',
        'agent.length' => '登录标识长度不正确,允许的长度1~255',
        'languages.length' => '语言长度不正确,允许的长度1~255',
        'device.length' => '内核长度不正确,允许的长度1~255',
        'browser.length' => '浏览器长度不正确,允许的长度1~255',
        'version_browser.length' => '浏览器版本长度不正确,允许的长度1~255',
        'platform.length' => '平台长度不正确,允许的长度1~255',
        'version_platform.length' => '平台版本长度不正确,允许的长度1~255',
        'mobile.integer' => '是否移动端格式错误',
        'mobile.between' => '是否移动端取值范围在 1~127',
        'robot.length' => '机器人长度不正确,允许的长度1~255',
    ];
}