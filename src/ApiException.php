<?php


namespace magein\thinkphp_extra;

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
        // 请求异常
        if ($e instanceof HttpException && $request->isAjax()) {
            return ApiReturn::code(ApiCode::HTTP_REQUEST_METHOD_ILLEGAL, $e->getMessage());
        }

        // 保存数据，验证失败的错误信息
        if ($e instanceof ValidateException) {
            return ApiReturn::code(ApiCode::HTTP_REQUEST_POST_ILLEGAL, $e->getMessage());
        }

        // 数据库错误
        if ($e instanceof PDOException) {
            return ApiReturn::code(ApiCode::DATABASE_ERROR, $e->getMessage());
        }

        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}