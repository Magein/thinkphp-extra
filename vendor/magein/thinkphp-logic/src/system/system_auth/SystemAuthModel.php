<?php

namespace magein\thinkphp_logic\system\system_auth;

use magein\thinkphp_extra\Model;

/**
 * Class SystemAuthModel
 * @package app\components\system\system_auth
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $path
 * @property string $group
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class SystemAuthModel extends Model
{
    protected $table = 'system_auth';        
        
    protected $schema = [
        'id' => 'integer',
        'title' => 'string',
        'type' => 'string',
        'path' => 'string',
        'group' => 'string',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];
    
    
    /**
     * @param $value
     * @param $data
     * @return array|string
     */                
    protected function getTypeTextAttr($value, $data)
    {
        return SystemAuth::instance()->transType($data['type'] ?? '');
    }
}    