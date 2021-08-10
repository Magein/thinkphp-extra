<?php

namespace magein\thinkphp_extra\api;

use app\components\good\good_category\GoodCategory;
use magein\thinkphp_extra\ApiReturn;
use magein\thinkphp_logic\app\app_banner\AppBanner;

use hg\apidoc\annotation as Apidoc;

class MallBaseApi
{
    /**
     * @Apidoc\Title("轮播图")
     * @Apidoc\Url("/mall/base/getBanner")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("title", type="string", desc="标题")
     * @Apidoc\Returned("redirect", type="string", desc="跳转地址")
     * @Apidoc\Returned("path", type="array", desc="图片路径")
     */
    public function getBanner()
    {
        $scene = request()->get('scene');

        return ApiReturn::success(AppBanner::instance()->getEffectivegListByScene($scene));
    }

    /**
     * @Apidoc\Title("商品分类")
     * @Apidoc\Url("/mall/base/getCategory")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("pid", type="int", desc="父级ID")
     * @Apidoc\Returned("title", type="string", desc="分类标题")
     * @Apidoc\Returned("icon", type="string", desc="分类图标")
     */
    public function getCategory()
    {
        $scene = request()->get('scene');

        return ApiReturn::success(GoodCategory::instance()->getListByScene($scene));
    }

    /**
     * @Apidoc\Title("商品基础信息")
     * @Apidoc\Url("/mall/base/getGoodBaseInfo")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("pid", type="int", desc="父级ID")
     * @Apidoc\Returned("title", type="string", desc="分类标题")
     * @Apidoc\Returned("icon", type="string", desc="分类图标")
     */
    public function getGoodBaseInfo()
    {
        return ApiReturn::success(GoodCategory::instance()->getListByScene());
    }

    /**
     * @Apidoc\Title("关于我们")
     * @Apidoc\Url("/mall/base/getAbout")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("pid", type="int", desc="父级ID")
     * @Apidoc\Returned("title", type="string", desc="分类标题")
     * @Apidoc\Returned("icon", type="string", desc="分类图标")
     */
    public function getAbout()
    {
        return ApiReturn::success(GoodCategory::instance()->getListByScene());
    }

    /**
     * @Apidoc\Title("常见问题")
     * @Apidoc\Url("/mall/base/getQuestion")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("pid", type="int", desc="父级ID")
     * @Apidoc\Returned("title", type="string", desc="分类标题")
     * @Apidoc\Returned("icon", type="string", desc="分类图标")
     */
    public function getQuestion()
    {
        return ApiReturn::success(GoodCategory::instance()->getListByScene());
    }

    /**
     * @Apidoc\Title("上传图片")
     * @Apidoc\Url("/mall/base/uploadImage")
     * @Apidoc\Returned("id", type="int", desc="id")
     * @Apidoc\Returned("pid", type="int", desc="父级ID")
     * @Apidoc\Returned("title", type="string", desc="分类标题")
     * @Apidoc\Returned("icon", type="string", desc="分类图标")
     */
    public function uploadImage()
    {
        return ApiReturn::success(GoodCategory::instance()->getListByScene());
    }
}