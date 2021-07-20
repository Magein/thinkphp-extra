<?php

namespace magein\thinkphp_extra\traits;

trait Sex
{
    /**
     * @param null|int $status
     * @return string|array
     */
    public function transSex($sex = null)
    {
        $data = [
            0 => '保密',
            1 => '男',
            2 => '女'
        ];

        if ($sex !== null) {
            return $data[$sex] ?? '';
        }

        return $data;
    }
}