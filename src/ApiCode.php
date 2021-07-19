<?php


namespace magein\thinkphp_extra;

class ApiCode
{
    // 请求成功
    const SUCCESS = 0;

    // 请求失败
    const ERROR = 1;

    // http请求被拒绝
    const HTTP_REQUEST_REFUSE = 10001;
    // http请求的接口没有权限
    const HTTP_REQUEST_API_ILLEGAL = 10002;
    // HTTP请求的method非法
    const HTTP_REQUEST_METHOD_ILLEGAL = 10003;
    // HTTP请求参数非法，为空或者类型不对
    const HTTP_REQUEST_QUERY_ILLEGAL = 10005;
    // HTTP post请求参数错误
    const HTTP_REQUEST_POST_ILLEGAL = 10006;

    // 数据库错误
    const DATABASE_ERROR = 40001;

    // 渲染视图错误 找不到对应的视图安全类
    const VIEW_SECURITY_ERROR = 50001;
    // 渲染的视图错误  找不到对应的业务类
    const VIEW_LOGIC_ERROR = 50002;
}