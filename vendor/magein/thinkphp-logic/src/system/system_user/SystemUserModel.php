<?php

namespace magein\thinkphp_logic\system\system_user;

use magein\thinkphp_extra\Model;

/**
 * Class SystemUserModel
 * @package app\components\system\system_user
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $nickname
 * @property string $phone
 * @property string $email
 * @property integer $sex
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class SystemUserModel extends Model
{
    protected $table = 'system_user';        
        
    protected $schema = [
        'id' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'nickname' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'sex' => 'integer',
        'status' => 'integer',
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
        return SystemUser::instance()->transSex($data['sex'] ?? '');
    }

    /**
     * @param $value
     * @param $data
     * @return array|string
     */                
    protected function getStatusTextAttr($value, $data)
    {
        return SystemUser::instance()->transStatus($data['status'] ?? '');
    }
}    