<?php

namespace magein\thinkphp_logic\system\system_user_config;

use magein\thinkphp_extra\Model;

/**
 * Class SystemUserConfigModel
 * @package app\components\system\system_user_config
 * @property integer $id
 * @property integer $user_id
 * @property string $role
 * @property string $auth
 * @property string $layout
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class SystemUserConfigModel extends Model
{
    protected $table = 'system_user_config';

    protected $schema = [
        'id' => 'integer',
        'user_id' => 'integer',
        'role' => 'string',
        'auth' => 'string',
        'layout' => 'string',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];

    protected function setRoleAttr($value, $data)
    {
        return $this->transString($value);
    }

    protected function getRoleAttr($value, $data)
    {
        return $this->transArray($value);
    }

    protected function setAuthAttr($value, $data)
    {
        return $this->transString($value);
    }

    protected function getAuthAttr($value, $data)
    {
        return $this->transArray($value);
    }

    protected function setLayoutAttr($value, $data)
    {
        if ($value && is_array($value)) {
            $value = json_encode($value);
        }

        return $value;
    }

    protected function getLayoutAttr($value, $data)
    {
        if ($value) {
            $value = json_decode($value, true);
        }

        return $value;
    }
}    