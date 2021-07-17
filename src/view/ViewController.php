<?php

namespace magein\thinkphp_extra\view;

use magein\thinkphp_extra\ApiReturn;
use magein\thinkphp_extra\view\DataView;
use magein\tools\common\Variable;
use think\Exception;

class ViewController
{
    /**
     * @param $name
     * @param $arguments
     * @return \think\Response
     */
    public function __call($name, $arguments)
    {
        $lists = explode('.', $name);
        $name = $lists[0] ?? '';
        $action = $lists[1] ?? '';
        if (empty($name) || empty($action)) {
            return ApiReturn::error('参数错误');
        }

        $name = (new Variable())->pascal($name);
        $name = 'view\\' . $name;

        try {
            $view = new DataView($name);
        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        if (isset($message)) {
            return ApiReturn::error($message);
        }

        if (isset($view)) {
            return $view->response($action);
        }

        return ApiReturn::success();
    }
}