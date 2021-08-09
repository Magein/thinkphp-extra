<?php

namespace magein\thinkphp_logic\system\system_user_login_log;

use magein\thinkphp_extra\view\DataSecurity;

class SystemUserLoginLogSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'user_id',
        'ip',
        'agent',
        'languages',
        'device',
        'browser',
        'version_browser',
        'platform',
        'version_platform',
        'mobile',
        'robot',
        'create_time',
    ];

    // 使用的业务类
    protected $model = SystemUserLoginLogModel::class;

    //  查询字段以及表达式
    protected $export = [];
    
    // 允许插入的数据
    protected $post = [];
    
    //允许更新的字段
    protected $put = [];
}