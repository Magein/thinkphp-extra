<?php

namespace magein\thinkphp_logic\app\app_banner;

use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;
use magein\thinkphp_extra\traits\Status;
use magein\thinkphp_extra\traits\StartTime;
use magein\thinkphp_extra\traits\Scene;
class AppBanner extends Logic
{
    use Instance; 
          
    use Status;
    use StartTime;
    use Scene;
    
    /**
     * 禁用
     * @var int
     */
    const STATUS_FORBID = 0;

    /**
     * 启用
     * @var int
     */
    const STATUS_OPEN = 1;

    /**
     * @var array 
     */
    protected $fields = [
        'id',
        'title',
        'desc',
        'redirect',
        'path',
        'scene',
        'status',
        'start_time',
        'end_time',
        'sort',
        'create_time',
    ];
}