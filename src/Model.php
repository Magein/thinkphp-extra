<?php
/**
 * Created by PhpStorm.
 * User: xiaomage
 * Date: 2020/12/9
 * Time: 11:33
 */

namespace magein\thinkphp_extra;

use magein\tools\common\UnixTime;
use think\model\concern\SoftDelete;

/**
 * Class UserModel
 * @package magein\thinkphp_extra
 * @property integer $start_time_text
 * @property integer $end_time_text
 * @property integer $complete_time_text
 * @property integer $cancel_time_text
 * @property integer $verify_time_text
 */
class Model extends \think\Model
{
    use SoftDelete;

    /**
     * 定义默认的主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 定义软删除字段的默认值
     * @var int
     */
    protected $defaultSoftDelete = 0;

    /**
     * 自动写入创建和更新的时间戳字段
     * @var bool
     */
    protected $autoWriteTimestamp = true;

    /**
     * 只读字段
     * @var array
     */
    protected $readonly = [
        'id',
        'create_time',
    ];

    /**
     * 设置密码
     * @param $value
     * @return bool|string
     */
    protected function setPasswordAttr($value)
    {
        if (function_exists('password')) {
            $value = password($value);
        } else {
            $value = sha1(md5(123456));
        }

        return $value;
    }

    /**
     * @param $value
     * @return int|string
     */
    protected function setStartTimeAttr($value)
    {
        if ($value) {
            return UnixTime::instance()->unix($value);
        }

        return '';
    }

    /**
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getStartTimeTextAttr($value, $data)
    {
        if ($data['start_time'] ?? '') {
            return date('Y-m-d H:i', $data['start_time']);
        }

        return '';
    }

    /**
     * @param $value
     * @return int|string
     */
    protected function setEndTimeAttr($value)
    {
        if ($value) {
            return UnixTime::instance()->unix($value);
        }

        return '';
    }

    /**
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getEndTimeTextAttr($value, $data)
    {
        if ($data['end_time'] ?? '') {
            return date('Y-m-d H:i', $data['end_time']);
        }

        return '';
    }

    /**
     * @param $value
     * @return int|string
     */
    protected function setCompleteTimeAttr($value)
    {
        if ($value) {
            return UnixTime::instance()->unix($value);
        }

        return '';
    }

    /**
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getCompleteTimeTextAttr($value, $data)
    {
        if ($data['complete_time'] ?? '') {
            return date('Y-m-d H:i', $data['complete_time']);
        }

        return '';
    }

    /**
     * @param $value
     * @return int|string
     */
    protected function setCancelTimeAttr($value)
    {
        if ($value) {
            return UnixTime::instance()->unix($value);
        }

        return '';
    }

    /**
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getCancelTimeTextAttr($value, $data)
    {
        if ($data['cancel_time'] ?? '') {
            return date('Y-m-d H:i', $data['cancel_time']);
        }

        return '';
    }

    /**
     * @param $value
     * @return int|string
     */
    protected function setVerifyTimeAttr($value)
    {
        if ($value) {
            return UnixTime::instance()->unix($value);
        }

        return '';
    }

    /**
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getVerifyTimeTextAttr($value, $data)
    {
        if ($data['verify_time'] ?? '') {
            return date('Y-m-d H:i', $data['verify_time']);
        }

        return '';
    }

    /**
     * @param $value
     * @return int|string
     */
    protected function setCreateTimeAttr($value)
    {
        if ($value) {
            return UnixTime::instance()->unix($value);
        }

        return '';
    }

    /**
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getCreateTimeTextAttr($value, $data)
    {
        if ($data['create_time'] ?? '') {
            return date('Y-m-d H:i', $data['create_time']);
        }

        return '';
    }

    /**
     * @param $value
     * @return array
     */
    protected function transArray($value): array
    {
        if ($value) {
            $value = explode(',', $value);
        } else {
            $value = [];
        }

        return $value;
    }

    /**
     * @param $value
     * @return string
     */
    protected function transString($value): string
    {
        if ($value && is_array($value)) {
            $value = implode(',', $value);
        } else {
            $value = '';
        }

        return $value;
    }

    /**
     * @param $value
     * @return string
     */
    protected function setSceneAttr($value): string
    {
        return $this->transString($value);
    }

    /**
     * @param $value
     * @return array
     */
    protected function getSceneArrayAttr($value): array
    {
        return $this->transArray($value);
    }

    /**
     * @param $value
     * @return string
     */
    protected function setExtraAttr($value)
    {
        if ($value && is_array($value)) {
            $value = json_encode($value);
        }

        return $value;
    }

    /**
     * @param $value
     * @return array
     */
    protected function getExtraAttr($value)
    {
        if ($value) {
            $value = json_decode($value, true);
        }

        return $value;
    }
}