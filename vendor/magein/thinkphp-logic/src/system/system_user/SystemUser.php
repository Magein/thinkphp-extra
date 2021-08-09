<?php

namespace magein\thinkphp_logic\system\system_user;

use magein\thinkphp_extra\MsgContainer;
use magein\tools\common\RegVerify;
use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;
use magein\thinkphp_extra\traits\Status;
use magein\thinkphp_extra\traits\Sex;

class SystemUser extends Logic
{
    use Instance;

    use Status;
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
     * 禁用
     * @var int
     */
    const STATUS_FORBID = 0;

    /**
     * 启用
     * @var int
     */
    const STATUS_OPEN = 1;

    /**
     * @var array
     */
    protected $fields = [
        'id',
        'username',
        'password',
        'nickname',
        'phone',
        'email',
        'sex',
        'status',
        'create_time',
    ];

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
            $record = SystemUserModel::where(['username' => $username])->find();
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
     * @param $user_id
     * @param $old
     * @param $new
     * @param $confirm
     * @return bool
     */
    public function setPasswordByOld($user_id, $old, $new, $confirm): bool
    {
        if (empty($old) || empty($new) || empty($confirm)) {
            return MsgContainer::msg('请填写旧密码、新密码、确认密码');
        }

        $record = $this->find($user_id);
        if (empty($record) || !password($old, $record->password)) {
            return MsgContainer::msg('您的旧密码输入错误');
        }

        if (!preg_match('/[\w]{8,18}/', $new)) {
            return MsgContainer::msg('密码允许长度8~18位数字、字母、下划线组合');
        }

        if ($new !== $confirm) {
            return MsgContainer::msg('新密码、确认密码不一致');
        }
        $record->password = $new;

        return $record->save();
    }

    /**
     * @param $user_id
     * @param $phone
     * @return bool
     */
    public function setPhone($user_id, $phone): bool
    {
        if (empty($user_id) || empty($phone)) {
            return MsgContainer::msg('请输入手机号码');
        }

        if (!RegVerify::phone($phone)) {
            return MsgContainer::msg('手机号码格式不正确');
        }

        $record = $this->getByPhone($phone);
        if ($record && $record->id != $user_id) {
            return MsgContainer::msg('手机号码已经被占用');
        }

        $record = $this->find($user_id);
        if (empty($record)) {
            return MsgContainer::msg('用户信息错误');
        }
        $record->phone = $phone;
        return $record->save();
    }
}