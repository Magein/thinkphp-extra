<?php

namespace magein\thinkphp_logic\member\member_address;

use magein\thinkphp_extra\view\DataSecurity;

class MemberAddressSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'member_id',
        'nickname',
        'phone',
        'spare_phone',
        'province_id',
        'city_id',
        'area_id',
        'address',
        'house',
        'location',
        'tag',
        'is_use',
        'create_time',
    ];

    // 使用的业务类
    protected $model = MemberAddressModel::class;

    //  查询字段以及表达式
    protected $export = [];
    
    // 允许插入的数据
    protected $post = [];
    
    //允许更新的字段
    protected $put = [];
}