<?php

namespace magein\thinkphp_extra\api;

use magein\thinkphp_logic\member\Member;

use hg\apidoc\annotation as Apidoc;

abstract class MallUserCenterApi
{
    /**
     * 会员的id
     * @return integer
     */
    abstract protected function uuid(): int;

    /**
     * @Apidoc\Title("会员信息")
     * @Apidoc\Url("/mall/UserCenter/getInfo")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function getInfo()
    {
        return Member::instance()->getById($this->uuid());
    }

    /**
     * @Apidoc\Title("编辑信息")
     * @Apidoc\Url("/mall/UserCenter/setInfo")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function setInfo()
    {

    }

    /**
     * @Apidoc\Title("收货地址")
     * @Apidoc\Url("/mall/UserCenter/getAddress")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function getAddress()
    {

    }

    /**
     * @Apidoc\Title("编辑地址")
     * @Apidoc\Url("/mall/UserCenter/setAddress")
     * @Apidoc\Method("POST")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function setAddress()
    {

    }

    /**
     * @Apidoc\Title("财务列表")
     * @Apidoc\Url("/mall/UserCenter/getFinance")
     * @Apidoc\Method("GET")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function getFinance()
    {

    }

    /**
     * @Apidoc\Title("积分列表")
     * @Apidoc\Url("/mall/UserCenter/getIntegral")
     * @Apidoc\Method("GET")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function getIntegral()
    {

    }

    /**
     * @Apidoc\Title("消息列表")
     * @Apidoc\Url("/mall/UserCenter/getMessage")
     * @Apidoc\Method("GET")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function getMessage()
    {

    }

    /**
     * @Apidoc\Title("订单列表")
     * @Apidoc\Url("/mall/UserCenter/getMessage")
     * @Apidoc\Method("GET")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function getOrder()
    {

    }
}