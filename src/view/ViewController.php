<?php

namespace magein\thinkphp_extra\view;

use magein\thinkphp_extra\ApiReturn;
use magein\tools\common\Variable;
use think\Exception;

class ViewController
{

    /**
     * 安全参数路径
     * @var string
     */
    protected $namespace = 'view';

    /**
     * @param $name
     * @param $arguments
     * @return \think\Response
     */
    public function __call($name, $arguments)
    {
        $route = request()->route();

        $name = $route['controller'] ?? '';
        $action = $route['action'] ?? '';

        if (empty($name) || empty($action)) {
            return ApiReturn::error('参数错误');
        }

        if (false === $this->auth()) {
            return ApiReturn::error('尚未获得权限');
        };

        $name = (new Variable())->pascal($name);
        $name = $this->namespace . '\\' . $name;

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

    /**
     * 权限控制
     * @return bool
     */
    protected function auth()
    {
        return false;
    }
}