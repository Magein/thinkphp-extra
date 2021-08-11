<?php

namespace magein\thinkphp_extra\api;

use magein\thinkphp_extra\ApiReturn;
use magein\thinkphp_logic\member\Member;

use hg\apidoc\annotation as Apidoc;
use magein\thinkphp_logic\member\member_address\MemberAddress;
use magein\thinkphp_logic\member\member_finance\MemberFinance;

abstract class MallUserCenterApi
{
    /**
     * 会员的id
     * @return integer
     */
    abstract protected function uuid(): int;

    /**
     * @Apidoc\Title("会员信息")
     * @Apidoc\Url("/mall/userCenter/getInfo")
     * @Apidoc\Returned("id", type="integer", desc="")
     * @Apidoc\Returned("phone", type="string", desc="手机号码")
     * @Apidoc\Returned("nickname", type="string", desc="昵称")
     * @Apidoc\Returned("avatar", type="string", desc="头像")
     * @Apidoc\Returned("email", type="string", desc="邮箱地址")
     * @Apidoc\Returned("sex", type="tinyint", desc="性别 0 保密 secret 1 男 man 2 女 woman")
     * @Apidoc\Returned("age", type="integer", desc="年龄")
     * @Apidoc\Returned("money", type="float", desc="总消费金额")
     * @Apidoc\Returned("balance", type="float", desc="余额")
     * @Apidoc\Returned("province_id", type="integer", desc="省")
     * @Apidoc\Returned("city_id", type="integer", desc="市")
     * @Apidoc\Returned("area_id", type="integer", desc="县")
     * @Apidoc\Returned("address", type="string", desc="所在地")
     * @Apidoc\Returned("create_time", type="integer", desc="创建时间")
     */
    public function getInfo()
    {
        return ApiReturn::success(Member::instance()->getById($this->uuid()));
    }

    /**
     * @Apidoc\Title("编辑信息")
     * @Apidoc\Url("/mall/UserCenter/setInfo")
     * @Apidoc\Method ("POST")
     * @Apidoc\Param("phone", type="string", desc="手机号码")
     * @Apidoc\Param("nickname", type="string", desc="昵称")
     * @Apidoc\Param("avatar", type="string", desc="头像")
     * @Apidoc\Param("email", type="string", desc="邮箱地址")
     * @Apidoc\Param("sex", type="integer", desc="性别 0 保密 secret 1 男 man 2 女 woman")
     * @Apidoc\Param("age", type="integer", desc="年龄")
     * @Apidoc\Param("province_id", type="integer", desc="省")
     * @Apidoc\Param("city_id", type="integer", desc="市")
     * @Apidoc\Param("area_id", type="integer", desc="县")
     * @Apidoc\Param("address", type="string", desc="所在地")
     */
    public function setInfo()
    {
        $data = request()->only(
            [
                'phone',
                'nickname',
                'avatar',
                'email',
                'sex',
                'age',
                'province_id',
                'area_id',
                'area_id',
                'address',
            ], 'post');

        $data['id'] = $this->uuid();

        $data = array_filter($data);

        return ApiReturn::success(Member::instance()->save($data));
    }

    /**
     * @Apidoc\Title("收货地址")
     * @Apidoc\Url("/mall/userCenter/getAddress")
     * @Apidoc\Param("id", type="int", desc="传递则获取对应的信息 为空则获取所有的")
     * @Apidoc\Param("used", type="int", desc="0 所有  1 默认的 当传递id时，此值失效")
     * @Apidoc\Returned("id", type="integer", desc="")
     * @Apidoc\Returned("member_id", type="integer", desc="会员编号")
     * @Apidoc\Returned("nickname", type="string", desc="收货人名称")
     * @Apidoc\Returned("phone", type="string", desc="收货人号码")
     * @Apidoc\Returned("spare_phone", type="string", desc="备用号码 收货人联系不上的时候可以联系的号码")
     * @Apidoc\Returned("province_id", type="integer", desc="省")
     * @Apidoc\Returned("city_id", type="integer", desc="市")
     * @Apidoc\Returned("area_id", type="integer", desc="县")
     * @Apidoc\Returned("address", type="string", desc="位置")
     * @Apidoc\Returned("house", type="string", desc="门牌号")
     * @Apidoc\Returned("location", type="string", desc="经纬度 经度在前，纬度在后")
     * @Apidoc\Returned("tag", type="integer", desc="标签")
     * @Apidoc\Returned("is_use", type="integer", desc="常用 0 不 no 1 是 yes")
     */
    public function getAddress()
    {
        $id = request()->get('id');
        $is_used = request()->get('used', 0);

        if ($id) {
            $record = MemberAddress::instance()->find($id);
            if ($record && $record['member_id'] != $this->uuid()) {
                $record = null;
            }
        } else {
            $record = MemberAddress::instance()->getListByMemberId($this->uuid(), $is_used);
        }

        return ApiReturn::success($record);
    }

    /**
     * @Apidoc\Title("编辑地址")
     * @Apidoc\Url("/mall/UserCenter/setAddress")
     * @Apidoc\Method("POST")
     * @Apidoc\Param("id", type="integer", desc="编号")
     * @Apidoc\Param("nickname", type="string", desc="收货人名称")
     * @Apidoc\Param("phone", type="string", desc="收货人号码")
     * @Apidoc\Param("spare_phone", type="string", desc="备用号码 收货人联系不上的时候可以联系的号码")
     * @Apidoc\Param("province_id", type="integer", desc="省")
     * @Apidoc\Param("city_id", type="integer", desc="市")
     * @Apidoc\Param("area_id", type="integer", desc="县")
     * @Apidoc\Param("address", type="string", desc="位置")
     * @Apidoc\Param("house", type="string", desc="门牌号")
     * @Apidoc\Param("location", type="string", desc="经纬度 经度在前，纬度在后")
     * @Apidoc\Param("tag", type="integer", desc="标签")
     * @Apidoc\Param("is_use", type="integer", desc="常用 0 不 no 1 是 yes")
     */
    public function setAddress()
    {
        $data = request()->only(
            [
                'id',
                'nickname',
                'phone',
                'spare_phone',
                'province_id',
                'city_id',
                'area_id',
                'address',
                'house',
                'location',
                'tag',
                'is_use',
            ], 'post');

        if ($data['id'] ?? 0) {
            $record = MemberAddress::instance()->find($data['id']);
            if ($record && $record['member_id'] != $this->uuid()) {
                return ApiReturn::error('参数非法');
            }
        }

        $data['member_id'] = $this->uuid();
        $data = array_filter($data);

        return ApiReturn::success(MemberAddress::instance()->save($data));
    }

    /**
     * @Apidoc\Title("财务列表")
     * @Apidoc\Url("/mall/userCenter/getFinance")
     * @Apidoc\Method("GET")
     * @Apidoc\Param("id",type="integer",require=false,desc="主键")
     * @Apidoc\Param("page",type="integer",require=false,desc="第几页")
     * @Apidoc\Param("page_size",type="integer",require=false,desc="每页数量")
     * @Apidoc\Returned("id", type="integer", desc="")
     * @Apidoc\Returned("member_id", type="integer", desc="编号")
     * @Apidoc\Returned("type", type="integer", desc="财务类型 1 收入 increase 2 支出 decrease")
     * @Apidoc\Returned("action", type="integer", desc="动作 11 充值 recharge 22 支付订单 pay_order")
     * @Apidoc\Returned("money", type="float", desc="金额")
     * @Apidoc\Returned("before", type="float", desc="前置金额 操作之间的金额")
     * @Apidoc\Returned("order_no", type="string", desc="订单编号 每笔财务日志都要有对应的订单编号哪怕是虚拟的")
     * @Apidoc\Returned("remark", type="string", desc="备注")
     * @Apidoc\Returned("create_time", type="integer", desc="创建时间")
     */
    public function getFinance()
    {
        $id = request()->get('id', 0, 'intval');

        if ($id) {
            $record = MemberFinance::instance()->find($id);
            if ($record && $record['member_id'] != $this->uuid()) {
                $record = null;
            }
        } else {
            $page_size = request()->get('page_size', 20);
            $record = MemberFinance::instance()->getListByMemberId($this->uuid(), $page_size);
        }

        return ApiReturn::success($record);
    }

    /**
     * @Apidoc\Title("积分列表")
     * @Apidoc\Url("/mall/userCenter/getIntegral")
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