<?php


namespace magein\thinkphp_extra;

class ApiCode
{
    // 请求成功
    const SUCCESS = 0;

    // 请求失败
    const ERROR = 1;

    // HTTP 请求被拒绝 X-REQUEST-ID 错误
    const HTTP_REQUEST_REFUSE = 10001;
    // HTTP token错误
    const HTTP_REQUEST_TOKEN_ERROR = 10003;
    // HTTP 请求的接口没有权限
    const HTTP_REQUEST_API_ILLEGAL = 10005;
    // HTTP 请求的method非法
    const HTTP_REQUEST_METHOD_ILLEGAL = 10006;
    // HTTP 请求参数非法，为空或者类型不对
    const HTTP_REQUEST_QUERY_ILLEGAL = 10007;
    // HTTP post请求参数错误
    const HTTP_REQUEST_POST_ILLEGAL = 10008;

    // 数据库错误
    const DATABASE_ERROR = 40001;

    // 渲染视图错误 找不到对应的视图安全类
    const VIEW_SECURITY_ERROR = 50001;
    // 渲染的视图错误  找不到对应的业务类
    const VIEW_MODEL_ERROR = 50002;
}