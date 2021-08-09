<?php

namespace magein\thinkphp_logic\member;

use magein\thinkphp_extra\Model;

/**
 * Class MemberModel
 * @package app\components\member
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $phone
 * @property string $nickname
 * @property string $email
 * @property integer $sex
 * @property integer $age
 * @property float $money
 * @property float $balance
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $address
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class MemberModel extends Model
{
    protected $table = 'member';        
        
    protected $schema = [
        'id' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'phone' => 'string',
        'nickname' => 'string',
        'email' => 'string',
        'sex' => 'integer',
        'age' => 'integer',
        'money' => 'float',
        'balance' => 'float',
        'province_id' => 'integer',
        'city_id' => 'integer',
        'area_id' => 'integer',
        'address' => 'string',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];
    
    
    /**
     * @param $value
     * @param $data
     * @return array|string
     */                
    protected function getSexTextAttr($value, $data)
    {
        return Member::instance()->transSex($data['sex'] ?? '');
    }
}    