<?php


namespace magein\thinkphp_extra\traits;


use magein\thinkphp_extra\MsgContainer;
use think\db\exception\DbException;

trait StartTime
{
    public function getEffectivegList()
    {
        try {
            $model = $this->model();
            $records = $model->whereTime('start_time', '<=', time())
                ->whereTime('end_time', '>=', time())
                ->order('sort', 'asc')
                ->select();
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
            $model = $this->model();
            $records = $model->whereTime('start_time', '>', time())->order('sort', 'asc')->select();
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
            $model = $this->model();
            $records = $model->whereTime('end_time', '<', time())->order('sort', 'asc')->select();
        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $records = null;
        }

        return $records;
    }
}