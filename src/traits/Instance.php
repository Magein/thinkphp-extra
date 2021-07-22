<?php


namespace magein\thinkphp_extra\traits;

trait Instance
{
    protected static $instance = null;

    /**
     * 获取实例
     * @return static
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}