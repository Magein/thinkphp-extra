<?php

namespace magein\thinkphp_logic\system\system_auth;

use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;

class SystemAuth extends Logic
{
    use Instance;


    /**
     * 普通的
     * @var int
     */
    const TYPE_NORMAL = 1;

    /**
     * 虚拟的
     * @var int
     */
    const TYPE_VIRTUAL = 2;

    /**
     * @var array
     */
    protected $fields = [
        'id',
        'title',
        'type',
        'path',
        'group',
        'create_time',
    ];


    /**
     * @param mixed $type
     * @return array|string
     */
    public function transType($type = null)
    {
        $data = [
            self::TYPE_NORMAL => '普通的',
            self::TYPE_VIRTUAL => '虚拟的',
        ];

        if (null !== $type) {
            return $data[$type] ?? '';
        }

        return $data;
    }


    /**
     * @param $path
     * @return array|false|\think\Model|null
     */
    public function getByPath($path)
    {
        if (empty($path)) {
            return false;
        }

        try {
            $record = $this->model()->where(['path' => $path])->find();
        } catch (DbException $exception) {
            $record = null;
        }

        return $record;
    }

    /**
     * @param $id
     * @return \think\Collection|null
     */
    public function getListById($id)
    {
        if (empty($id)) {
            return null;
        }

        try {
            $record = $this->model()->where(['id' => $id])->select();
        } catch (DbException $exception) {
            $record = null;
        }

        return $record;
    }

}