<?php


namespace magein\thinkphp_extra;


class MsgContainer
{
    private $queue = [];

    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return MsgContainer|null
     */
    public static function instance(): MsgContainer
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     *
     * @param $message
     * @param int $code
     * @param null $data
     * @return false
     */
    public static function msg($message, int $code = 1, $data = null): bool
    {
        self::instance()->queue[] = [
            'msg' => $message,
            'code' => $code,
            'data' => $data
        ];

        return false;
    }

    /**
     * @param int $code
     * @param null $data
     * @return false
     */
    public function code(int $code, $data = null): bool
    {
        $this->queue[] = [
            'msg' => '',
            'code' => $code,
            'data' => $data
        ];

        return false;
    }

    /**
     * @return array
     */
    public function queue(): array
    {
        return $this->queue;
    }

    /**
     * @return array
     */
    public function first(): array
    {
        return $this->queue[0] ?? [];
    }

    /**
     * @return array
     */
    public function last(): array
    {
        if (count($this->queue) === 0) {
            return [];
        }

        return $this->queue[count($this->queue) - 1] ?? [];
    }
}