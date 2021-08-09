<?php

namespace magein\thinkphp_logic\system\system_user;

use magein\thinkphp_extra\view\DataSecurity;

class SystemUserSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'username',
        'password',
        'nickname',
        'phone',
        'email',
        'sex',
        'status',
        'create_time',
    ];

    // 使用的业务类
    protected $model = SystemUserModel::class;

    //  查询字段以及表达式
    protected $export = [];

    // 允许插入的数据
    protected $post = [
        'username',
        'password',
        'nickname',
        'phone',
        'email',
        'sex',
    ];

    //允许更新的字段
    protected $put = [
        'username',
        'nickname',
        'phone',
        'email',
        'sex',
    ];
}