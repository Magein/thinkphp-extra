<?php

namespace magein\thinkphp_logic\app\app_banner;

use magein\thinkphp_extra\view\DataSecurity;

class AppBannerSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'title',
        'desc',
        'redirect',
        'path',
        'scene',
        'status',
        'start_time',
        'end_time',
        'sort',
        'create_time',
    ];

    // 使用的业务类
    protected $model = AppBannerModel::class;

    //  查询字段以及表达式
    protected $export = [];
    
    // 允许插入的数据
    protected $post = [];
    
    //允许更新的字段
    protected $put = [];
}