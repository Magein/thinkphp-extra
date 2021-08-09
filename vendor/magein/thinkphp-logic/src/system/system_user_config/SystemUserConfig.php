<?php

namespace magein\thinkphp_logic\system\system_user_config;

use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;

class SystemUserConfig extends Logic
{
    use Instance;

    /**
     * @var array
     */
    protected $fields = [
        'id',
        'user_id',
        'role',
        'auth',
        'layout',
        'create_time',
    ];

    /**
     * @param $user_id
     * @return array|false|\think\Model|null
     */
    public function getByUserId($user_id)
    {
        if (empty($user_id)) {
            return false;
        }

        try {
            $record = $this->model()->where(['user_id' => $user_id])->find();
        } catch (DbException $exception) {
            $record = null;
        }

        return $record;
    }

}