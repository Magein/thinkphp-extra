<?php

namespace magein\thinkphp_logic\member\member_address;

use think\Validate;

class MemberAddressValidate extends Validate
{
    protected $rule = [
        'member_id' => 'require|integer',
        'nickname' => 'require|length:1,255',
        'phone' => 'require|number|length:11',
        'spare_phone' => 'length:6,18',
        'province_id' => 'integer|require',
        'city_id' => 'integer|require',
        'area_id' => 'integer|require',
        'address' => 'require|length:1,255',
        'house' => 'length:1,255',
        'location' => 'length:1,255',
        'tag' => 'integer',
        'is_use' => 'integer|in:0,1',
    ];

    protected $message = [
        'member_id.require' => '请输入编号',
        'member_id.integer' => '编号格式错误',
        'nickname.require' => '请输入收货人名称',
        'nickname.length' => '收货人名称长度不正确,允许的长度1~255',
        'phone.require' => '请输入收货人号码',
        'phone.number' => '收货人号码格式错误',
        'phone.length' => '收货人号码长度不正确,允许的长度1~255',
        'spare_phone.length' => '备用号码长度不正确,允许的长度6~18',
        'province_id.require' => '请输入省份',
        'province_id.integer' => '省格式错误',
        'city_id.require' => '请输入城市',
        'city_id.integer' => '市格式错误',
        'area_id.require' => '请输入县区',
        'area_id.integer' => '县格式错误',
        'address.require' => '请输入地址',
        'address.length' => '位置长度不正确,允许的长度1~255',
        'house.length' => '门牌号长度不正确,允许的长度1~255',
        'location.length' => '经纬度长度不正确,允许的长度1~255',
        'tag.integer' => '标签格式错误',
        'is_use.integer' => '常用格式错误',
        'is_use.in' => '常用可选值错误',
    ];
}