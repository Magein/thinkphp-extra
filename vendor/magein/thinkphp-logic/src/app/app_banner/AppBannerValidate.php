<?php

namespace magein\thinkphp_logic\app\app_banner;

use think\Validate;

class AppBannerValidate extends Validate
{
    protected $rule = [
        'title' => 'require|length:1,255',
        'desc' => 'length:1,255',
        'redirect' => 'length:1,255',
        'path' => 'require|length:1,800',
        'scene' => 'length:1,255',
        'status' => 'integer|in:0,1',
        'start_time' => 'date',
        'end_time' => 'date',
        'sort' => 'integer|between:1,127',
    ];

    protected $message = [
        'title.require' => '请输入标题',
        'title.length' => '标题长度不正确,允许的长度1~255',
        'desc.length' => '描述长度不正确,允许的长度1~255',
        'redirect.length' => '跳转地址长度不正确,允许的长度1~255',
        'path.require' => '请输入图片地址',
        'path.length' => '图片地址长度不正确,允许的长度1~800',
        'scene.length' => '使用场景长度不正确,允许的长度1~255',
        'status.integer' => '状态格式错误',
        'status.in' => '状态可选值错误',
        'sort.integer' => '排序格式错误',
        'sort.between' => '排序取值范围在 1~127',
    ];
}