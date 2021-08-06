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
                if (empty($item['scene'])) {
                    continue;
                }
                if (is_string($item['scene'])) {
                    $item['scene'] = explode(',', $item['scene']);
                }
                if (in_array($scene, $item['scene'])) {
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
            $records = $model->where('status', 1)->order('sort', 'asc')->select();
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
            $condition = [
                'start_time' => ['elt', time()],
                'end_time' => ['egt', time()],
                'status' => 1,
            ];
            $model = $this->model();
            $records = $model->where($condition)->order('sort', 'asc')->select();
        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $records = null;
        }

        return $this->filterByScene($records, $scene);
    }
}