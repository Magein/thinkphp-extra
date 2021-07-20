<?php

namespace magein\thinkphp_extra\traits;

trait Verify
{
    /**
     * @param $id
     * @param $verify
     * @param string $reason
     * @return array
     */
    public function setVerify($id, $verify, $reason = '')
    {
        $verify = intval($verify);

        if (!in_array($verify, [-1, 0, 1])) {
            return [];
        }

        $params['id'] = $id;
        $params['verify'] = $verify;
        $params['reason'] = $reason;

        return $this->save($params, null);
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