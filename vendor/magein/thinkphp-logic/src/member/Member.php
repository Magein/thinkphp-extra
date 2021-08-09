<?php

namespace magein\thinkphp_logic\member;

use magein\thinkphp_extra\MsgContainer;
use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;
use magein\thinkphp_extra\traits\Sex;
use think\facade\Db;

class Member extends Logic
{
    use Instance;

    use Sex;

    /**
     * 保密
     * @var int
     */
    const SEX_SECRET = 0;

    /**
     * 男
     * @var int
     */
    const SEX_MAN = 1;

    /**
     * 女
     * @var int
     */
    const SEX_WOMAN = 2;

    /**
     * @var array
     */
    protected $fields = [
        'id',
        'username',
        'password',
        'phone',
        'nickname',
        'email',
        'sex',
        'age',
        'money',
        'balance',
        'province_id',
        'city_id',
        'area_id',
        'address',
        'create_time',
    ];

    /**
     * @param $id
     * @return array|false|\think\Model|null
     */
    public function getById($id)
    {
        if (empty($id)) {
            return false;
        }

        try {
            $record = $this->model()->where(['id' => $id])->find();
        } catch (DbException $exception) {
            $record = null;
        }

        return $record;
    }

    /**
     * @param $username
     * @return array|false|\think\Model|null
     */
    public function getByUsername($username)
    {
        if (empty($username)) {
            return false;
        }

        try {
            $record = $this->model()->where(['username' => $username])->find();
        } catch (DbException $exception) {
            $record = null;
        }

        return $record;
    }

    /**
     * @param $phone
     * @return array|false|\think\Model|null
     */
    public function getByPhone($phone)
    {
        if (empty($phone)) {
            return false;
        }

        try {
            $record = $this->model()->where(['phone' => $phone])->find();
        } catch (DbException $exception) {
            $record = null;
        }

        return $record;
    }

    /**
     * 设置用户余额增加
     * @param $member_id
     * @param $money
     * @return \app\components\member\MemberModel|false|null
     */
    public function increaseBalance($member_id, $money)
    {
        $money = floatval($money);
        if ($money <= 0) {
            return false;
        }

        try {
            /**
             * @var \app\components\member\MemberModel $record
             */
            $record = $this->model()->where(['id' => $member_id])->find();
            if (empty($record)) {
                return false;
            }

            if ($record) {
                $record->before = $record->balance;
                $record->balance = Db::raw('balance+' . $money);
                $record->save();
            }

        } catch (DbException $exception) {
            MsgContainer::msg($exception->getMessage());
            $record = false;
        }

        return $record;
    }
}