<?php


namespace magein\thinkphp_extra\traits;


use magein\thinkphp_extra\MsgContainer;
use think\db\exception\DbException;

trait StartTime
{
    public function getEffectivegList()
    {
        try {
            $condition = [
                'start_time' => ['elt', time()],
                'end_time' => ['egt', time()],
            ];
            $model = $this->model();
            $records = $model->where($condition)->order('sort', 'asc')->select();
        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $records = null;
        }

        return $records;
    }

    /**
     * @return \think\Collection|null
     */
    public function getNotStartList()
    {
        try {
            $condition = [
                'start_time' => ['gt', time()],
            ];
            $model = $this->model();
            $records = $model->where($condition)->order('sort', 'asc')->select();
        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $records = null;
        }

        return $records;
    }

    /**
     * 已经结束的列表
     * @return \think\Collection|null
     */
    public function getOverList()
    {
        try {
            $condition = [
                'end_time' => ['lt', time()],
            ];
            $model = $this->model();
            $records = $model->where($condition)->order('sort', 'asc')->select();
        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $records = null;
        }

        return $records;
    }
}