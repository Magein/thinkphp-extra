<?php

namespace magein\thinkphp_logic\system\system_auth;

use magein\thinkphp_extra\view\DataSecurity;

class SystemAuthSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'title',
        'type',
        'path',
        'group',
        'create_time',
    ];

    // 使用的业务类
    protected $model = SystemAuthModel::class;

    //  查询字段以及表达式
    protected $export = [];
    
    // 允许插入的数据
    protected $post = [];
    
    //允许更新的字段
    protected $put = [];
}