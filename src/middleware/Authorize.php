<?php
/**
 * Created by PhpStorm.
 * User: xiaomage
 * Date: 2020/12/8
 * Time: 10:48
 */

namespace magein\thinkphp_extra\middleware;

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
            return json()->code(401);
        }

        $result = JsonToken::instance()->setKey($this->key)->verify($token);
        if (false === $result) {
            return json()->code(401);
        }

        if (!JsonToken::instance()->getSign()) {
            return json()->code(401);
        }

        return $next($request);
    }
}