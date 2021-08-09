<?php

namespace magein\thinkphp_logic\member\member_address;

use magein\thinkphp_extra\Model;

/**
 * Class MemberAddressModel
 * @package app\components\member\member_address
 * @property integer $id
 * @property integer $member_id
 * @property string $nickname
 * @property string $phone
 * @property string $spare_phone
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $address
 * @property string $house
 * @property string $location
 * @property integer $tag
 * @property integer $is_use
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class MemberAddressModel extends Model
{
    protected $table = 'member_address';        
        
    protected $schema = [
        'id' => 'integer',
        'member_id' => 'integer',
        'nickname' => 'string',
        'phone' => 'string',
        'spare_phone' => 'string',
        'province_id' => 'integer',
        'city_id' => 'integer',
        'area_id' => 'integer',
        'address' => 'string',
        'house' => 'string',
        'location' => 'string',
        'tag' => 'integer',
        'is_use' => 'integer',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];
    
    
    /**
     * @param $value
     * @param $data
     * @return array|string
     */                
    protected function getIsUseTextAttr($value, $data)
    {
        return MemberAddress::instance()->transIsUse($data['is_use'] ?? '');
    }
}    