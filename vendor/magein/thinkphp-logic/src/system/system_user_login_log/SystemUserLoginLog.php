<?php

namespace magein\thinkphp_logic\system\system_user_login_log;

use Jenssegers\Agent\Agent;
use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;

class SystemUserLoginLog extends Logic
{
    use Instance;


    /**
     * @var array
     */
    protected $fields = [
        'id',
        'user_id',
        'ip',
        'agent',
        'languages',
        'device',
        'browser',
        'version_browser',
        'platform',
        'version_platform',
        'mobile',
        'robot',
        'create_time',
    ];

    /**
     * @param $user_id
     * @return bool
     */
    public function create($user_id)
    {
        $agent = new Agent();
        $model = new SystemUserLoginLogModel();
        $model->user_id = $user_id;
        $model->ip = request()->ip();
        $model->agent = $agent->getUserAgent();
        $model->languages = $agent->languages();
        $model->device = $agent->device();
        $model->browser = $agent->browser();
        $model->version_browser = $agent->version($agent->browser());
        $model->platform = $agent->platform();
        $model->version_platform = $agent->version($agent->platform());
        $model->mobile = $agent->isPhone();
        $model->robot = $agent->robot();
        return $model->save();
    }
}