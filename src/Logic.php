<?php

namespace magein\thinkphp_extra;

use think\db\Query;
use think\Exception;
use think\exception\ErrorException;
use think\exception\ValidateException;

/**
 * Class Logic
 * @package common\logic
 *
 */
abstract class Logic
{
    protected static $instance = null;

    /**
     * \think\Model
     * @var null
     */
    protected $model = null;

    /**
     * 拥有的字段信息
     * @var array
     */
    protected $fields = [];

    /**
     * 过滤的字段
     * @var string[]
     */
    public $withoutField = ['delete_time', 'update_time'];

    /**
     * 获取实例
     * @return static
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * 获取或者设置model
     * @return \think\db\Query
     */
    public function model()
    {
        $namespace = static::class . 'Model';
        if (class_exists($namespace)) {
            $model = new $namespace();
            $model = $model->withoutField($this->withoutField);
        } else {
            $model = null;
        }

        return $model;
    }

    /**
     * 返回设置的字段信息
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * 根据主键获取
     * @param $primary_id
     * @return mixed
     */
    public function find($primary_id = null)
    {
        $model = $this->model();

        return $model->find($primary_id);
    }

    /**
     * 获取最后一个
     * @return mixed
     */
    public function getLast()
    {
        $model = $this->model();
        return $model->order('id', 'desc')->find();
    }

    /**
     * @return array
     */
    public function select()
    {
        $model = $this->model();

        if (request()->param('page')) {
            $page_size = request()->param('page_size', 15);
            $records = $model->paginate($page_size);
        } else {
            $records = $model->select();
        }

        return $records ? $records : [];
    }

    /**
     * @param int $page_id
     * @param int $page_size
     * @return array|\think\Paginator
     */
    public function paginate($page_id = 1, $page_size = 15)
    {
        $model = $this->model();

        $records = $model->paginate($page_size);

        return $records ? $records : [];
    }

    /**
     * @param $key
     * @param $field
     * @return array
     */
    public function column($key, $field)
    {
        return $this->model()->column($field, $key);
    }

    /**
     * @param $data
     * @param null $validate
     * @param null $scene
     * @return bool|string
     */
    public function save($data, $validate = null, $scene = null)
    {
        if (empty($data) || !is_array($data)) {
            return MsgContainer::msg('', ApiCode::HTTP_REQUEST_POST_ILLEGAL);
        }

        $primary = $data['id'] ?? '';

        if ($validate) {
            if ($scene) {
                validate($validate)->scene($scene)->check($data);
            } elseif (empty($primary)) {
                validate($validate)->check($data);
            }
        }

        $model = $this->model();
        if ($primary) {
            $record = $model::find($primary);
            $result = $record->save($data);
            return $result === false ? false : intval($primary);
        } else {
            $result = $model->save($data);
            if ($result) {
                return intval($model->id);
            }
            return false;
        }
    }

    /**
     * 保存全部
     * @param $data
     * @param $validate
     * @param null $scene
     * @return mixed
     */
    public function saveAll($data, $validate, $scene = null)
    {
        if ($validate) {
            foreach ($data as $item) {
                if ($scene) {
                    validate($validate)->scene($scene)->check($item);
                } elseif (empty($primary)) {
                    validate($validate)->check($item);
                }
            }
        }

        return $this->model()->saveAll($data);
    }

    /**
     * 删除数据
     * @param $pk
     * @param bool $force 是否强制删除
     * @return mixed
     */
    public function delete($pk, $force = false)
    {
        $force = boolval($force);

        if ($force) {
            $result = call_user_func_array([$this->model(), 'destroy'], [$pk, $force]);
        } else {
            $result = call_user_func_array([$this->model(), 'destroy'], [$pk]);
        }

        return $result;
    }

    /**
     * 恢复数据
     * @param $pk
     * @return bool|int
     */
    public function recovery($pk)
    {
        $model = call_user_func_array([$this->model(), 'onlyTrashed'], []);
        $record = $model->find($pk);
        $result = true;
        if ($record) {
            $result = $record->restore();
        }
        return $result;
    }
}