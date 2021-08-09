<?php

namespace magein\thinkphp_logic\system\system_user_role;

use magein\thinkphp_extra\Model;

/**
 * Class SystemUserRoleModel
 * @package app\components\system\system_user_role
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $auth
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class SystemUserRoleModel extends Model
{
    protected $table = 'system_user_role';

    protected $schema = [
        'id' => 'integer',
        'title' => 'string',
        'desc' => 'string',
        'auth' => 'string',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];

    protected function setAuthAttr($value, $data)
    {
        return $this->transString($value);
    }

    protected function getAuthAttr($value, $data)
    {
        return $this->transArray($value);
    }
}    