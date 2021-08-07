<?php


namespace magein\thinkphp_extra\traits;


use magein\thinkphp_extra\MsgContainer;
use think\db\exception\DbException;

trait Scene
{
    /**
     * @param $records
     * @param $scene
     * @return array|mixed
     */
    private function filterByScene($records, $scene)
    {
        if ($scene && $records) {
            $list = [];
            foreach ($records as $item) {
                if (empty($item->scene_array)) {
                    continue;
                }
                if (in_array($scene, $item->scene_array)) {
                    $list[] = $item;
                }
            }
            $records = $list;
        }
        return $records;
    }

    /**
     * @param null $scene
     * @return array|mixed
     */
    public function getListByScene($scene = null)
    {
        try {
            $model = $this->model();
            $records = $model
                ->append(['scene_array'])
                ->where('status', 1)
                ->order('sort', 'asc')
                ->select();
        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $records = null;
        }

        return $this->filterByScene($records, $scene);
    }

    /**
     * 根据场景值获取有效的数据列表
     * @return array|mixed
     */
    public function getEffectivegListByScene($scene = null)
    {
        try {
            $model = $this->model();
            $records = $model->whereTime('start_time', '<=', time())
                ->whereTime('end_time', '>=', time())
                ->where('status', 1)
                ->order('sort', 'asc')
                ->append(['scene_array'])
                ->select();
        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $records = null;
        }

        return $this->filterByScene($records, $scene);
    }
}