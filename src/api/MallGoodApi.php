<?php


namespace magein\thinkphp_extra\api;

use hg\apidoc\annotation as Apidoc;

class MallGoodApi
{
    /**
     * @Apidoc\Title("商品信息")
     * @Apidoc\Url("/mall/good/info")
     * @Apidoc\Returned("order_no", type="int", desc="id")
     */
    public function info()
    {

    }
}