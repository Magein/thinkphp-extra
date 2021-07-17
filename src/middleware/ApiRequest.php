<?php
/**
 * Created by PhpStorm.
 * User: xiaomage
 * Date: 2020/12/8
 * Time: 13:45
 */

namespace magein\thinkphp_extra\middleware;

use magein\tools\security\XRequestId;
use think\Request;

class ApiRequest
{
    protected $key = '2zm38w4zkMy7q4zV2hFuWbJ11FKhVk03';

    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        /**
         * 设置允许跨域请求
         *
         * 这里没有使用thinkphp6内置的跨域请求是应为 请求头中有自定义的字段信息，
         *
         * X-Request-id、Token
         */
        header('Content-Type: text/html;charset=utf-8');
        // * 代表允许任何网址请求
        header('Access-Control-Allow-Origin: *');
        // 允许请求的类型
        header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE,PUT,PATCH');
        // 设置是否允许发送 cookies
        header('Access-Control-Allow-Credentials: true');
        // 设置允许自定义请求头的字段  这里要特别出主意
        header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with,Origin,X-Request-id,Token');

        $request_id = $request->header('X-Request-id');

        $result = XRequestId::verify($request_id, $this->key);
        if (false === $result) {
            //403 服务器理解请求客户端的请求，但是拒绝执行此请求
            return json()->code(403);
        }

        return $next($request);
    }
}