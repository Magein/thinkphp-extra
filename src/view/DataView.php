<?php

namespace magein\thinkphp_extra\view;

use magein\thinkphp_extra\ApiCode;
use magein\thinkphp_extra\ApiReturn;
use magein\thinkphp_extra\Logic;
use magein\thinkphp_extra\MsgContainer;
use magein\tools\common\UnixTime;
use think\Exception;

class DataView
{

    /**
     * @var DataSecurity
     */
    protected $view;

    /**
     * @var \magein\thinkphp_extra\Logic
     */
    protected $logic;

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

        $logic = $dataSecurity->getLogic();

        try {
            if ($logic && class_exists($logic)) {
                $this->logic = new $logic();
                $this->view->setFields();
            }
        } catch (Exception $exception) {

        }
    }

    /**
     * @return \think\Response
     */
    public function response($method)
    {
        if (!$this->logic instanceof Logic) {
            return ApiReturn::code(ApiCode::VIEW_LOGIC_ERROR);
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

        $model = $this->logic->model();

        if ($this->view->getExport()) {
            $model = $model->field($this->view->getExport());
            $this->logic->withoutField = [];
        }

        $this->logic->model($model);

        return $this->logic->find($id);
    }

    /**
     * 获取数据列表
     * @return array|\think\Collection|\think\Paginator
     */
    protected function lists()
    {

        $params = $this->search();
        $model = $this->logic->model();
        if ($params) {
            $model = $model->where($params);
        }

        if ($this->view->getExport()) {
            $model = $model->field($this->view->getExport());
            $this->logic->withoutField = [];
        }

        $this->logic->model($model);

        return $this->logic->select();
    }

    /**
     * 新增数据
     * @return bool|string
     */
    protected function post()
    {
        $params = request()->only($this->view->getPost(), 'post');

        $validate = get_class($this->logic) . 'Validate';

        try {
            if (!class_exists($validate)) {
                $validate = '';
            }
        } catch (Exception $exception) {

        }

        return $this->logic->save($params, $validate);
    }

    /**
     * 局部更新patch也指向put
     * 更新数据()
     * @return bool|string
     */
    protected function put()
    {
        $id = request()->put('id', 0);

        $params = request()->only($this->view->getPut(), 'put');

        $validate = get_class($this->logic) . 'Validate';

        try {
            if (!class_exists($validate)) {
                $validate = '';
            }
        } catch (Exception $exception) {

        }

        if (empty($id)) {
            return MsgContainer::msg('更新数据异常', ApiCode::HTTP_REQUEST_PARAM_ERROR);
        }

        $params['id'] = $id;

        return $this->logic->save($params, $validate, 'put');
    }

    /**
     * 这里使用了patch 用户更新一个字段，即delete_time从有值变成0
     * 恢复数据
     * @return bool|int
     */
    protected function recovery()
    {
        $id = request()->patch('id');

        if (empty($id)) {
            return MsgContainer::msg('数据恢复失败', ApiCode::HTTP_REQUEST_PARAM_ERROR);
        }

        return $this->logic->recovery($id);
    }

    /**
     * 删除、强制删除
     * @return mixed
     */
    protected function delete()
    {
        $id = request()->delete('id');
        $clear = request()->delete('clear', 0);

        if (empty($id)) {
            return MsgContainer::msg('数据删除失败', ApiCode::HTTP_REQUEST_PARAM_ERROR);
        }

        return $this->logic->delete($id, $clear);
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
        unset($params['page']);

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