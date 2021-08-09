<?php

namespace magein\thinkphp_logic\member\member_finance;

use think\Validate;

class MemberFinanceValidate extends Validate
{
    protected $rule = [
        'member_id' => 'require|integer',
        'type' => 'require|integer|in:1,2',
        'action' => 'require|integer|in:11,22',
        'money' => 'require|float',
        'before' => 'float',
        'order_no' => 'require|length:1,255',
        'remark' => 'length:1,255',
        'oid' => 'require|integer',
        'otype' => 'require|integer|in:1,2',
    ];

    protected $message = [
        'member_id.require' => '请输入编号',
        'member_id.integer' => '编号格式错误',
        'type.require' => '请输入财务类型',
        'type.integer' => '财务类型格式错误',
        'type.in' => '财务类型可选值错误',
        'action.require' => '请输入动作',
        'action.integer' => '动作格式错误',
        'action.in' => '动作可选值错误',
        'money.require' => '请输入金额',
        'money.float' => '金额格式错误',
        'before.float' => '前置金额格式错误',
        'order_no.require' => '请输入订单编号',
        'order_no.length' => '订单编号长度不正确,允许的长度1~255',
        'remark.length' => '备注长度不正确,允许的长度1~255',
        'oid.require' => '请输入操作员',
        'oid.integer' => '操作员格式错误',
        'otype.require' => '请输入操作员',
        'otype.integer' => '操作员格式错误',
        'otype.in' => '操作员可选值错误',
    ];
}