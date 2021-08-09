<?php

namespace magein\thinkphp_extra\api;

use magein\thinkphp_logic\member\Member;

abstract class MemberCenterApi
{
    /**
     * 会员的id
     * @return integer
     */
    abstract protected function uuid(): int;

    /**
     * 获取会员信息
     * @return array|null
     */
    public function getInfo()
    {
        return Member::instance()->getById($this->uuid());
    }

    /**
     * 设置个人信息
     */
    public function setInfo()
    {

    }

    /**
     * 获取收货地址
     */
    public function getAddress()
    {

    }

    /**
     * 设置收货地址
     */
    public function setAddress()
    {

    }

    /**
     * 获取财务列表
     */
    public function getFinance()
    {

    }

    /**
     * 获取积分
     */
    public function getIntegral()
    {

    }

    /**
     * 获取消息
     */
    public function getMessage()
    {

    }

    /**
     * 获取订单信息
     */
    public function getOrder()
    {

    }
}