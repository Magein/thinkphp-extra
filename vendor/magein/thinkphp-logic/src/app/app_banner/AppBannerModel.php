<?php

namespace magein\thinkphp_logic\app\app_banner;

use magein\thinkphp_extra\Model;

/**
 * Class AppBannerModel
 * @package app\components\app\app_banner
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $redirect
 * @property string $path
 * @property string $scene
 * @property integer $status
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $sort
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class AppBannerModel extends Model
{
    protected $table = 'app_banner';

    protected $schema = [
        'id' => 'integer',
        'title' => 'string',
        'desc' => 'string',
        'redirect' => 'string',
        'path' => 'string',
        'scene' => 'string',
        'status' => 'integer',
        'start_time' => 'integer',
        'end_time' => 'integer',
        'sort' => 'integer',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];


    /**
     * @param $value
     * @param $data
     * @return array|string
     */
    protected function getStatusTextAttr($value, $data)
    {
        return AppBanner::instance()->transStatus($data['status'] ?? '');
    }

    /**
     * @param $value
     * @param $data
     * @return string
     */
    protected function setPathAttr($value, $data): string
    {
        return $this->transString($value);
    }

    /**
     * @param $value
     * @param $data
     * @return array
     */
    protected function getPathAttr($value, $data): array
    {
        return $this->transArray($value);
    }
}    