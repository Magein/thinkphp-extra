<?php

namespace magein\thinkphp_extra\traits;

trait Title
{
    /**
     * @param $id
     * @param $verify
     * @param string $reason
     * @return array
     */
    public function getTitle()
    {
        return $this->column('id', 'title');
    }

    /**
     * @param null|int $status
     * @return string|array
     */
    public function transVerify($verify = null)
    {
        $verify = [
            -1 => '已拒绝',
            0 => '待审核',
            1 => '已通过'
        ];

        if ($status !== null) {
            return $data[$verify] ?? '';
        }

        return $data;
    }

    /**
     * @param int $verify
     * @return array
     */
    public function getListByVerify($verify = 1)
    {
        $verify = intval($verify);

        if (!in_array($verify, [-1, 0, 1])) {
            return [];
        }

        return $this->where(['verify' => $verify])->select();
    }
}