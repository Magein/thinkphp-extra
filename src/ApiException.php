<?php


namespace app\common;

use magein\thinkphp_extra\ApiReturn;
use think\db\exception\PDOException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;
use Throwable;

class ApiException extends Handle
{
    public function render($request, Throwable $e): Response
    {
        // 参数验证错误
        if ($e instanceof ValidateException) {
            return ApiReturn::error($e->getMessage());
        }

        // 数据库错误
        if ($e instanceof PDOException) {
            return ApiReturn::code(4001, '服务器出错了~');
        }

        // 请求异常
        if ($e instanceof HttpException && $request->isAjax()) {
            return ApiReturn::error($e->getMessage());
        }

        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}