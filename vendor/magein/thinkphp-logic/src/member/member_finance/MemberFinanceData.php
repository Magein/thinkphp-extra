<?php


namespace magein\thinkphp_logic\member\member_finance;

use app\components\member\Member;
use magein\tools\common\Variable;

class MemberFinanceData
{
    /**
     * @var int
     */
    private $member_id = 0;

    /**
     * @var string
     */
    private $phone = '';

    /**
     * @var string
     */
    private $order_no = '';

    /**
     * @var int
     */
    private $action = 0;

    /**
     * @var int
     */
    private $type = 0;

    /**
     * @var int
     */
    private $money = 0;

    /**
     * @var string
     */
    private $remark = '';

    /**
     * @var int
     */
    private $notice = 0;

    /**
     * 是否使用事务
     * @var bool
     */
    private $commit = true;

    /**
     * 操作者类型 默认1表示用户自己，理论上不要随便操作用户的余额信息，只有客户自己才能操作
     * @var string
     */
    private $otype = '';

    /**
     * 操作者id
     * @var string
     */
    private $oid = '';

    public function __construct()
    {
        $this->init();
    }

    /**
     * 初始化数据
     */
    public function init()
    {
        $data = request()->only(['member_id', 'phone', 'action', 'type', 'money', 'remark', 'notice'], 'post');
        foreach ($data as $key => $item) {
            $name = 'set' . Variable::instance()->pascal($key);
            if (method_exists($this, $name)) {
                $this->$name($item);
            }
        }
    }

    /**
     * @return int
     */
    public function getMemberId(): int
    {
        return $this->member_id;
    }

    /**
     * @param int|string $member_id
     */
    public function setMemberId($member_id): void
    {
        $member_id = intval($member_id);

        $this->member_id = $member_id;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        if ($phone && empty($this->member_id)) {
            $record = Member::instance()->getByPhone($phone);
            if ($record) {
                $this->member_id = $record['id'];
            }
        }

        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getOrderNo(): string
    {
        return $this->order_no;
    }

    /**
     * @param string $order_no
     */
    public function setOrderNo(string $order_no): void
    {
        $this->order_no = $order_no;
    }

    /**
     * @return int
     */
    public function getAction(): int
    {
        return $this->action;
    }

    /**
     * @param int|string $action
     */
    public function setAction($action): void
    {
        $action = intval($action);

        $this->action = $action;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int|string $type
     */
    public function setType($type): void
    {
        $type = intval($type);

        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getMoney(): int
    {
        return $this->money;
    }

    /**
     * @param int|string|float $money
     */
    public function setMoney($money): void
    {
        $money = floatval($money);

        $this->money = $money;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     */
    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return int
     */
    public function getNotice(): int
    {
        return $this->notice;
    }

    /**
     * @param int $notice
     */
    public function setNotice(int $notice): void
    {
        $this->notice = $notice;
    }

    /**
     * @return bool
     */
    public function isCommit(): bool
    {
        return $this->commit;
    }

    /**
     * @param bool $commit
     */
    public function setCommit(bool $commit): void
    {
        $this->commit = $commit;
    }

    /**
     * @return int
     */
    public function getOtype(): int
    {
        if (empty($this->otype)) {
            $this->otype = 1;
        }

        return (int)$this->otype;
    }

    /**
     * @param int|string $otype
     */
    public function setOtype($otype): void
    {
        $this->otype = (int)$otype;
    }

    /**
     * @return int
     */
    public function getOid(): int
    {
        if (empty($this->oid)) {
            $this->oid = $this->member_id;
        }

        return (int)$this->oid;
    }

    /**
     * @param string|integer $oid
     */
    public function setOid($oid): void
    {
        $this->oid = (int)$oid;
    }
}