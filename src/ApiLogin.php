<?php


namespace magein\thinkphp_extra;


use think\facade\Cache;

class ApiLogin
{
    /**
     * @var integer
     */
    protected static $uuid = 0;

    /**
     * @param int|string $uuid
     * @return integer|null
     */
    public static function uuid($uuid = 0)
    {
        if ($uuid) {
            $uuid = intval($uuid);
            self::$uuid = $uuid;
            return null;
        } else {
            return self::$uuid;
        }
    }

    /**
     * @return string
     */
    protected static function getCacheName(): string
    {
        return 'user_login_data_' . self::$uuid;
    }

    /**
     * @param $data
     * @param null $sign
     */
    public static function setUserInfo($data, $sign = null)
    {
        try {
            $sign = $sign ?: $data['id'] ?? 0;
            self::uuid($sign);
            Cache::store('file')->set(self::getCacheName(), $data);
        } catch (\Psr\SimpleCache\InvalidArgumentException $exception) {

        }
    }

    /**
     * @param string|null $field
     * @return array|string
     */
    public static function getUserInfo($field = null)
    {
        try {
            $data = Cache::store('file')->get(self::getCacheName());
        } catch (\Psr\SimpleCache\InvalidArgumentException $exception) {
            $data = [];
        }

        if ($field) {
            return $data[$field] ?? '';
        }

        return $data;
    }
}