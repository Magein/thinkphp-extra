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
        $route = request()->route();

        $name = $route['controller'] ?? '';
        $action = $route['action'] ?? '';

        if (empty($name) || empty($action)) {
            return ApiReturn::error(ApiCode::HTTP_REQUEST_QUERY_ILLEGAL);
        }

        if (false === $this->auth()) {
            return ApiReturn::error(ApiCode::HTTP_REQUEST_API_ILLEGAL);
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

        }

        return ApiReturn::code(ApiCode::VIEW_SECURITY_ERROR);
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