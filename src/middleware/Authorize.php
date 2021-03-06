<?php
/**
 * Created by PhpStorm.
 * User: xiaomage
 * Date: 2020/12/8
 * Time: 10:48
 */

namespace magein\thinkphp_extra\middleware;

use magein\thinkphp_extra\ApiCode;
use magein\thinkphp_extra\ApiLogin;
use magein\thinkphp_extra\ApiReturn;
use magein\tools\security\JsonToken;
use think\Request;

class Authorize
{
    protected $key = 'fKwOLCXFrlkvVMjQgPRInUETx';

    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $token = $request->header('token');
        if (empty($token)) {
            // 请求要求用户的身份认证
            return ApiReturn::code(ApiCode::HTTP_REQUEST_TOKEN_ERROR);
        }

        $result = JsonToken::instance()->setKey($this->key)->verify($token);
        if (false === $result) {
            return ApiReturn::code(ApiCode::HTTP_REQUEST_TOKEN_ERROR);
        }

        if (!JsonToken::instance()->getSign()) {
            return ApiReturn::code(ApiCode::HTTP_REQUEST_TOKEN_ERROR);
        }

        $this->verifyComplete(JsonToken::instance()->getSign());

        return $next($request);
    }

    protected function verifyComplete($sign)
    {
        ApiLogin::uuid($sign);
    }
}