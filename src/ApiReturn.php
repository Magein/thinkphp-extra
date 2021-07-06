<?php
/**
 * Created by PhpStorm.
 * User: xiaomage
 * Date: 2020/11/24
 * Time: 14:14
 */

namespace magein\thinkphp_extra;

use think\Response;

class ApiReturn
{
    /**
     * @param $data
     * @return Response
     */
    public static function data($data): Response
    {
        return Response::create($data, 'json');
    }

    /**
     * @param null $data
     * @param string $message
     * @param int $code
     * @return Response
     */
    public static function success($data = null, $message = '', $code = 0): Response
    {
        return self::data(
            [
                'code' => $code,
                'msg' => $message,
                'data' => $data ?: null,
            ]
        );
    }

    /**
     * 错误
     * @param string $message
     * @param string $data
     * @param int $code
     * @return Response
     */
    public static function error($message = '', $data = '', $code = 1): Response
    {
        return self::data(
            [
                'code' => $code,
                'msg' => $message,
                'data' => $data === null ? null : $data,
            ]
        );
    }

    /**
     * @param $code
     * @param string $message
     * @param string $data
     * @return Response
     */
    public static function code($code, $message = '', $data = ''): Response
    {
        return self::data(
            [
                'code' => $code,
                'msg' => $message,
                'data' => $data
            ]
        );
    }

    public static function auto($result)
    {
        if ($result === false) {
            $message = MsgContainer::instance()->last();
            return self::error($message['msg'] ?? '', $message['data'] ?? '', $message['code'] ?? 1);
        }

        return self::success($result);
    }
}