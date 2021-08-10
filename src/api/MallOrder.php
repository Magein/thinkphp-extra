<?php


namespace magein\thinkphp_extra\api;

use hg\apidoc\annotation as Apidoc;

class MallOrder
{
    /**
     * @Apidoc\Title("创建订单")
     * @Apidoc\Url("/mall/order/create")
     * @Apidoc\Returned("order_no", type="int", desc="id")
     */
    public function create()
    {

    }

    /**
     * @Apidoc\Title("购物车")
     * @Apidoc\Url("/mall/order/getCart")
     * @Apidoc\Returned("id", type="int", desc="id")
     */
    public function getCart()
    {

    }

    /**
     * @Apidoc\Title("添加到购物车")
     * @Apidoc\Url("/mall/order/setCart")
     * @Apidoc\Returned("id", type="int", desc="id")
     */
    public function setCart()
    {

    }

    /**
     * @Apidoc\Title("可用优惠券列表")
     * @Apidoc\Url("/mall/order/coupon")
     * @Apidoc\Returned("id", type="int", desc="id")
     */
    public function getCoupon()
    {

    }
}