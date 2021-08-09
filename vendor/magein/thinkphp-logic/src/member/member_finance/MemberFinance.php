<?php

namespace magein\thinkphp_logic\member\member_finance;

use app\components\member\Member;
use magein\thinkphp_extra\MsgContainer;
use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;
use think\facade\Db;

class MemberFinance extends Logic
{
    use Instance;


    /**
     * 收入
     * @var int
     */
    const TYPE_INCREASE = 1;

    /**
     * 支出
     * @var int
     */
    const TYPE_DECREASE = 2;

    /**
     * 充值
     * @var int
     */
    const ACTION_RECHARGE = 11;

    /**
     * 支付订单
     * @var int
     */
    const ACTION_PAY_ORDER = 22;

    /**
     * 会员
     * @var int
     */
    const OTYPE_MEMBER = 1;

    /**
     * 管理员
     * @var int
     */
    const OTYPE_MANAGER = 2;

    /**
     * @var array
     */
    protected $fields = [
        'id',
        'member_id',
        'type',
        'action',
        'money',
        'before',
        'order_no',
        'remark',
        'oid',
        'otype',
        'create_time',
    ];

    /**
     * @param mixed $type
     * @return array|string
     */
    public function transType($type = null)
    {
        $data = [
            self::TYPE_INCREASE => '收入',
            self::TYPE_DECREASE => '支出',
        ];

        if (null !== $type) {
            return $data[$type] ?? '';
        }

        return $data;
    }

    /**
     * @param mixed $action
     * @return array|string
     */
    public function transAction($action = null)
    {
        $data = [
            self::ACTION_RECHARGE => '充值',
            self::ACTION_PAY_ORDER => '支付订单',
        ];

        if (null !== $action) {
            return $data[$action] ?? '';
        }

        return $data;
    }

    /**
     * @param mixed $otype
     * @return array|string
     */
    public function transOtype($otype = null)
    {
        $data = [
            self::OTYPE_MEMBER => '会员',
            self::OTYPE_MANAGER => '管理员',
        ];

        if (null !== $otype) {
            return $data[$otype] ?? '';
        }

        return $data;
    }

    /**
     * @param \app\components\member\member_finance\MemberFinanceData $financeData
     * @return bool|int
     */
    public function setBalance(MemberFinanceData $financeData)
    {
        if (empty($this->transType($financeData->getType()))) {
            return MsgContainer::msg('财务类型错误');
        }

        if (empty($this->transAction($financeData->getAction()))) {
            return MsgContainer::msg('财务行为错误');
        }

        if (!$financeData->getMemberId()) {
            return MsgContainer::msg('会员信息错误');
        }

        if (!$financeData->getOrderNo()) {
            return MsgContainer::msg('请输入订单编号');
        }

        if ($financeData->getMoney() <= 0) {
            return MsgContainer::msg('会员财务变化不能小于或等于0');
        }

        $success = function () use ($financeData) {

            $balance = $financeData->getMoney();
            $result = Member::instance()->increaseBalance($financeData->getMemberId(), $balance);

            if ($result === false) {
                return $result;
            }

            $finance = new MemberFinanceModel();
            $finance->member_id = $financeData->getMemberId();
            $finance->type = $financeData->getType();
            $finance->action = $financeData->getAction();
            $finance->money = $financeData->getMoney();
            $finance->remark = $financeData->getRemark();
            $finance->order_no = $financeData->getOrderNo();
            $finance->otype = $financeData->getOtype();
            $finance->oid = $financeData->getOid();
            $finance->before = $result->before;
            $finance->save();

            if ($finance->id) {
                return $finance->id;
            }

            return false;
        };

        $use_trans = $financeData->isCommit();

        if ($use_trans) {
            Db::startTrans();
            if ($success()) {
                Db::commit();
                return true;
            }
            Db::rollback();
            return false;
        }

        return $success();
    }

    /**
     * 设置用户余额增加
     * @param \app\components\member\member_finance\MemberFinanceData $financeData
     * @return bool
     */
    public function setBalanceIncrease(MemberFinanceData $financeData)
    {
        $financeData->setType(MemberFinance::TYPE_INCREASE);
        return $this->setBalance($financeData);
    }

    /**
     * 设置用户余额减少
     * @param \app\components\member\member_finance\MemberFinanceData $financeData
     * @return bool
     */
    public function setBalanceDecrease(MemberFinanceData $financeData)
    {
        $financeData->setType(MemberFinance::TYPE_DECREASE);
        return $this->setBalance($financeData);
    }

    /**
     * @param $order_no
     * @return false|\think\Collection|null
     */
    public function getListByOrderNo($order_no)
    {
        if (empty($order_no)) {
            return false;
        }

        try {
            $model = $this->model();
            $records = $model->where('order_no', $order_no)->select();
        } catch (DbException $exception) {
            $records = null;
        }

        return $records;
    }

}