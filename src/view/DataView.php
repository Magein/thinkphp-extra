<?php

namespace magein\thinkphp_extra\view;

use magein\thinkphp_extra\ApiCode;
use magein\thinkphp_extra\ApiReturn;
use magein\thinkphp_extra\MsgContainer;
use magein\thinkphp_extra\Overt;
use magein\tools\common\UnixTime;
use think\Exception;
use think\Model;

class DataView
{

    /**
     * @var DataSecurity
     */
    protected $view;

    /**
     * @var \think\Model
     */
    protected $model;

    /**
     * DataView constructor.
     * @param string $name
     * @throws \think\Exception
     */
    public function __construct(DataSecurity $name)
    {
        $this->setDataSecurity($name);
    }

    /**
     * @param DataSecurity $dataSecurity
     * @throws \think\Exception
     */
    public function setDataSecurity(DataSecurity $dataSecurity)
    {
        $this->view = $dataSecurity;
        $this->model = $dataSecurity->getModel();
        $this->view->setFields();
    }

    /**
     * @return \think\Response
     */
    public function response($method)
    {
        if (!$this->model instanceof Model) {
            return ApiReturn::code(ApiCode::VIEW_MODEL_ERROR);
        }

        $result = false;
        if (method_exists($this, $method)) {
            $result = call_user_func_array([$this, $method], []);
        }

        return ApiReturn::auto($result);
    }

    /**
     * 根据主键获取单条数据
     * @return array|\think\Model|null
     */
    protected function get()
    {
        $id = request()->get('id');

        $model = $this->model;

        $export = $this->view->getExport();
        if ($export) {
            $model = $model->field($this->view->getExport());
        } else {
            $model = $model->withoutField($this->view->getProtected());
        }

        return $model->find($id);
    }

    /**
     * 获取数据列表
     * @return array|\think\Collection|\think\Paginator
     */
    protected function list()
    {
        $params = $this->search();
        $model = $this->model;
        if ($params) {
            $model = $model->where($params);
        }

        $sort_by = request()->get('sort_by');
        if ($sort_by) {
            $sort_by = explode(',', $sort_by);
        } else {
            $sort_by = [];
        }
        $model = $model->order($sort_by[0] ?? 'id', $sort_by[1] ?? 'desc');

        $export = $this->view->getExport();
        if ($export) {
            $model = $model->field($this->view->getExport());
        } else {
            $model = $model->withoutField($this->view->getProtected());
        }

        $page_size = request()->get('page_size', 15);
        if ($page_size > 200) {
            $page_size = 200;
        }

        $result = $model->paginate($page_size);

        return Overt::paginate($result, $page_size);
    }

    /**
     * 新增数据
     * @return bool|string
     */
    protected function post()
    {
        $params = request()->only($this->view->getPost(), 'post');

        $validate = preg_replace('/Model/', 'Validate', get_class($this->model));

        if (class_exists($validate)) {
            validate($validate)->check($params);
        }

        $model = $this->model;

        return $model->save($params);
    }

    /**
     * 局部更新patch也指向put
     * 更新数据()
     * @return bool|string
     */
    protected function put()
    {
        $id = request()->put('id', 0);

        if (empty($id)) {
            return MsgContainer::msg('更新数据异常', ApiCode::HTTP_REQUEST_QUERY_ILLEGAL);
        }

        $params = request()->only($this->view->getPut(), 'put');
        unset($params['id']);

        $validate = preg_replace('/Model/', 'Validate', get_class($this->model));
        if (class_exists($validate)) {
            $validate = validate();
            if ($validate->hasScene('put')) {
                validate($validate)->scene('put')->check($params);
            }
        }

        $model = $this->model;
        $record = $model::find($id);

        if (empty($record)) {
            return MsgContainer::msg('数据记录不存在', ApiCode::HTTP_REQUEST_QUERY_ILLEGAL);
        }

        return $record->save($params);
    }

    /**
     * 删除、强制删除
     * @return mixed
     */
    protected function delete()
    {
        $id = request()->get('id');
        $clear = boolval(request()->get('clear', 0));

        if (empty($id)) {
            return MsgContainer::msg('数据删除失败', ApiCode::HTTP_REQUEST_QUERY_ILLEGAL);
        }

        if (is_int($id)) {
            $id = [$id];
        } elseif (is_string($id)) {
            $id = explode(',', $id);
        }

        $model = $this->model;

        if ($clear) {
            $result = $model->force()->delete(function ($query) use ($id) {
                $query->where('id', 'in', $id);
            });
        } else {
            $result = $model::destroy(function ($query) use ($id) {
                $query->where('id', 'in', $id);
            });
        }

        return $result;
    }

    /**
     * 恢复数据
     * 这里使用了patch 用户更新一个字段，即delete_time从有值变成0
     * @return bool|int
     */
    protected function recovery()
    {
        $id = request()->get('id');

        if (empty($id)) {
            return MsgContainer::msg('数据恢复失败', ApiCode::HTTP_REQUEST_QUERY_ILLEGAL);
        }


        if (is_int($id)) {
            $id = [$id];
        } elseif (is_string($id)) {
            $id = explode(',', $id);
        }

        $model = $this->model;

        $result = $model->restore(function ($query) use ($id) {
            $query->where('id', 'in', $id);
        });

        return $result;
    }

    /**
     * 设置搜索参数
     * @return array
     */
    protected function search(): array
    {
        $params = request()->get();
        if (empty($params)) {
            return [];
        }
        unset($params['page'], $params['sort_by']);

        // 查询参数
        $query = $this->view->getQuery();
        if (empty($query)) {
            $query = array_keys($params);
        }

        $condition = [];
        foreach ($query as $item) {
            if (is_array($item)) {
                $key = $item[0] ?? '';
                $express = $item[1] ?? '';
            } else {
                $key = $item;
                $express = '';
            }

            $value = $params[$key] ?? null;
            if ($value === null) {
                continue;
            }
            $value = trim($value);

            switch ($express) {
                case 'like':
                    $condition[] = [$key, 'like', '%' . $value . '%'];
                    break;
                case 'between':
                    $value = explode(',', $value);
                    $condition[] = [$key, 'between', $value];
                    break;
                // 2021-07-17 匹配成等于  2021-07-17,2021-07-18 匹配成范围
                case 'date':
                    $value = explode(',', $value);
                    $value = array_filter($value);
                    if (count($value) === 1) {
                        $condition[] = [$item, '=', UnixTime::instance()->unix($value[0])];
                    } else {
                        $start_time = UnixTime::instance()->begin($value[0]);
                        $end_time = UnixTime::instance()->end($value[1]);
                        $condition[] = [$item, 'between', [$start_time, $end_time]];
                    }
                    break;
                // 2021-07-17 22:00:00 匹配成等于  2021-07-17 22:00:00,2021-07-17 22:00:00 匹配成范围
                case 'datetime':
                    $value = explode(',', $value);
                    $value = array_filter($value);
                    if (count($value) === 1) {
                        $condition[] = [$item, '=', UnixTime::instance()->unix($value[0])];
                    } else {
                        $start_time = UnixTime::instance()->unix($value[0]);
                        $end_time = UnixTime::instance()->unix($value[1]);
                        $condition[] = [$item, 'between', [$start_time, $end_time]];
                    }
                    break;
                default:
                    $condition[] = [$item, '=', $value];
            }
        }

        return $condition;
    }
}