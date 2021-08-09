<?php

namespace magein\thinkphp_logic\system\system_user_login_log;

use magein\thinkphp_extra\Model;

/**
 * Class SystemUserLoginLogModel
 * @package app\components\system\system_user_login_log
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property string $agent
 * @property string $languages
 * @property string $device
 * @property string $browser
 * @property string $version_browser
 * @property string $platform
 * @property string $version_platform
 * @property integer $mobile
 * @property string $robot
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class SystemUserLoginLogModel extends Model
{
    protected $table = 'system_user_login_log';

    protected $schema = [
        'id' => 'integer',
        'user_id' => 'integer',
        'ip' => 'string',
        'agent' => 'string',
        'languages' => 'string',
        'device' => 'string',
        'browser' => 'string',
        'version_browser' => 'string',
        'platform' => 'string',
        'version_platform' => 'string',
        'mobile' => 'integer',
        'robot' => 'string',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];

    protected $json = ['languages'];

    /**
     * @param $value
     * @param $data
     * @return string
     */
    protected function getMobileTextAttr($value, $data)
    {
        return $data['mobile'] === 1 ? '是' : '否';
    }
}    