<?php

namespace magein\thinkphp_logic\system\system_user_action;

use magein\thinkphp_extra\Model;

/**
 * Class SystemUserActionModel
 * @package app\components\system\system_user_action
 * @property integer $id
 * @property integer $user_id
 * @property string $controller
 * @property string $action
 * @property string $ip
 * @property string $params
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class SystemUserActionModel extends Model
{
    protected $table = 'system_user_action';        
        
    protected $schema = [
        'id' => 'integer',
        'user_id' => 'integer',
        'controller' => 'string',
        'action' => 'string',
        'ip' => 'string',
        'params' => 'string',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];
    
    
}    