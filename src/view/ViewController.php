<?php

namespace magein\thinkphp_extra\view;

use magein\thinkphp_extra\ApiCode;
use magein\thinkphp_extra\ApiReturn;
use magein\tools\common\Variable;
use think\Exception;
use think\exception\ErrorException;

class ViewController
{

    /**
     * 安全参数路径
     * @var string
     */
    protected $namespace = 'view';

    /**
     * @param $name
     * @return string
     */
    protected function mapping()
    {
        return [];
    }

    /**
     * @param $name
     * @param $arguments
     * @return \think\Response
     */
    public function __call($name, $arguments)
    {
        $path = request()->pathinfo();
        $path = explode('/', $path);

        $name = $path[1] ?? '';
        $action = $path[2] ?? '';

        if (empty($name) || empty($action)) {
            return ApiReturn::code(ApiCode::HTTP_REQUEST_QUERY_ILLEGAL);
        }

        if (false === $this->auth()) {
            return ApiReturn::code(ApiCode::HTTP_REQUEST_API_ILLEGAL, '', request()->pathinfo());
        };

        $name = (new Variable())->pascal($name);
        $namespace = $this->mapping()[$name] ?? '';

        if (empty($namespace)) {
            $namespace = $this->namespace . '\\' . $name;
        }

        try {
            if (class_exists($namespace)) {
                $view = new DataView(new $namespace());
                return $view->response($action);
            }
        } catch (ErrorException $exception) {
            $message = $exception->getMessage();
        }

        return ApiReturn::code(ApiCode::VIEW_SECURITY_ERROR, $message);
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