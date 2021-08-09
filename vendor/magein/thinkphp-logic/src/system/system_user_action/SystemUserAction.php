<?php

namespace magein\thinkphp_logic\system\system_user_action;

use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;

class SystemUserAction extends Logic
{
    use Instance;


    /**
     * @var array
     */
    protected $fields = [
        'id',
        'user_id',
        'controller',
        'action',
        'ip',
        'params',
        'create_time',
    ];


}