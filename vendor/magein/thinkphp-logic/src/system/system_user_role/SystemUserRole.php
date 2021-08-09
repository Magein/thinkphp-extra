<?php

namespace magein\thinkphp_logic\system\system_user_role;

use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;

class SystemUserRole extends Logic
{
    use Instance; 
          
    

    /**
     * @var array 
     */
    protected $fields = [
        'id',
        'title',
        'desc',
        'auth',
        'create_time',
    ];
    
    
}