<?php

namespace magein\thinkphp_extra;

/**
 * Class Logic
 * @package common\logic
 *
 * @method static find($primary_id)
 * @method static where(...$_)
 */
abstract class Logic
{
    /**
     * @return mixed
     */
    abstract protected function model();

    /**
     * @var bool
     */
    public $fields = true;

    /**
     * 执行model类的方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $records = call_user_func_array([self::instance()->model(), $name], $arguments);
        return $records;
    }

    /**
     * 获取实例
     * @return static
     */
    public static function instance()
    {
        return new static();
    }


    /**
     * 查询数据
     * @param null $model
     * @return mixed|null
     */
    public function select($model = null)
    {
        $records = null;

        $model = $model ?: $this->model();

        $model = $model->field($this->fields);

        if (request()->param('page')) {

            $page_size = request()->param('page_size', 15);

            $records = call_user_func_array([$model, 'paginate'], [$page_size]);

        } else {

            $records = call_user_func_array([$model, 'select'], []);

        }

        return $records ? $records : null;
    }

    /**
     * 获取字段列
     * @param $fields
     * @param string $key
     * @param null $condition
     * @return array
     */
    public function column($fields, $key = 'id', $condition = null)
    {
        $model = $this->model();

        if ($condition) {
            $model = $model->where($condition);
        }

        $records = $model->column($fields, $key);

        return $records;
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
            return $result === false ? false : $primary;
        } else {
            $model = $this->model();
            $result = $model->save($data);
            if ($result) {
                return $model->id;
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