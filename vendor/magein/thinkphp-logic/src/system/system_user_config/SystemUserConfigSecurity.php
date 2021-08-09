<?php

namespace magein\thinkphp_logic\system\system_user_config;

use magein\thinkphp_extra\view\DataSecurity;

class SystemUserConfigSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'user_id',
        'role',
        'auth',
        'layout',
        'create_time',
    ];

    // 使用的业务类
    protected $model = SystemUserConfigModel::class;

    //  查询字段以及表达式
    protected $export = [];
    
    // 允许插入的数据
    protected $post = [];
    
    //允许更新的字段
    protected $put = [];
}