<?php

namespace magein\thinkphp_extra\traits;

trait Status
{
    /**
     * @param null|int $status
     * @return string|array
     */
    public function transStatus($status = null)
    {
        $data = [
            0 => '禁用',
            1 => '启用'
        ];

        if ($status !== null) {
            return $data[$status] ?? '';
        }

        return $data;
    }

    /**
     * @param $id
     * @param $status
     * @param string $reason
     * @return array|bool|string
     */
    public function setStatus($id, $status, $reason = '')
    {
        $status = intval($status);

        if (!in_array($status, [0, 1])) {
            return [];
        }

        $params['id'] = $id;
        $params['status'] = $status;
        $params['reason'] = $reason;

        return $this->save($params, null);
    }

    /**
     * @param int $status
     * @return array
     */
    public function getListByStatus($status = 1)
    {
        $status = intval($status);

        if (!in_array($status, [0, 1])) {
            return [];
        }

        return $this->where(['status' => $status])->select();
    }
}