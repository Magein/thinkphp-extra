<?php

namespace magein\thinkphp_extra;

use app\common\MsgContainer;
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
     * @return \think\Model
     */
    abstract protected function model();

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
     * @param $primary_id
     * @return mixed
     */
    public function find($primary_id = null)
    {
        if ($this->model === null) {
            $this->model = $this->model();
        }

        $this->model = $this->model->withoutField(['delete_time', 'update_time']);

        if (empty($primary_id)) {
            $record = $this->model->find();
        } else {
            $record = $this->model->find($primary_id);
        }

        $this->model = null;

        return $record;
    }

    /**
     * @return mixed
     */
    public function select()
    {
        if ($this->model === null) {
            $this->model = $this->model();
        }

        $this->model = $this->model->withoutField(['delete_time', 'update_time']);
        if (request()->param('page')) {
            $page_size = request()->param('page_size', 15);
            $records = $this->model->paginate($page_size);
        } else {
            $records = $this->model->select();
        }

        $this->model = null;

        return $records ? $records : null;
    }

    /**
     * @param $data
     * @param null $validate
     * @param null $scene
     * @return bool|string
     */
    public function save($data, $validate = null, $scene = null)
    {
        $primary = $data['id'] ?? '';

        if ($validate) {
            if ($scene) {
                validate($validate)->scene($scene)->check($data);
            } elseif (empty($primary)) {
                validate($validate)->check($data);
            }
        }

        if ($primary) {
            $model = self::find($primary);
            $result = $model->save($data);
            return $result === false ? false : intval($primary);
        } else {
            $model = $this->model();
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