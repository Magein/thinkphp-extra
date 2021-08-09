<?php

namespace magein\thinkphp_logic\member\member_finance;

use magein\thinkphp_extra\view\DataSecurity;

class MemberFinanceSecurity extends DataSecurity
{
    // 自动创建字段信息
    protected $fields = [
        'id',
        'member_id',
        'type',
        'action',
        'money',
        'before',
        'order_no',
        'remark',
        'oid',
        'otype',
        'create_time',
    ];

    // 使用的业务类
    protected $model = MemberFinanceModel::class;

    //  查询字段以及表达式
    protected $export = [];
    
    // 允许插入的数据
    protected $post = [];
    
    //允许更新的字段
    protected $put = [];
}