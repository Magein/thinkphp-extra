<?php

namespace magein\thinkphp_logic\member;

use magein\thinkphp_extra\view\DataSecurity;

class MemberSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'username',
        'password',
        'phone',
        'nickname',
        'email',
        'sex',
        'age',
        'money',
        'balance',
        'province_id',
        'city_id',
        'area_id',
        'address',
        'create_time',
    ];

    // 使用的业务类
    protected $model = MemberModel::class;

    //  查询字段以及表达式
    protected $export = [];
    
    // 允许插入的数据
    protected $post = [];
    
    //允许更新的字段
    protected $put = [];
}