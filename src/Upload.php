<?php

namespace magein\thinkphp_extra;

use magein\thinkphp_extra\MsgContainer;
use think\facade\Config;
use think\facade\Filesystem;

class Upload
{
    /**
     * @var string
     */
    protected $resources = '';

    /**
     * @var int
     */
    protected $storage = 1;

    /**
     * 上传到本地
     * @return $this
     */
    public function storageLocal()
    {
        $this->storage = 1;

        return $this;
    }

    /**
     * 上传到阿里云
     * @return $this
     */
    public function storageAliyun()
    {
        $this->storage = 2;

        return $this;
    }

    /**
     * @param $file
     * @return array|bool
     */
    public function image($file = null)
    {
        if ($file === null) {
            $file = request()->file('image');
        }

        if ($this->storage === 1) {
            $url = $this->local($file);
            $http_url = request()->domain() . $url;
        } else {
            $url = $this->aliyun($file);
            $http_url = $url;
        }

        if ($url === false) {
            return false;
        }

        return [
            'url' => $url,
            'http_url' => $http_url,
        ];
    }

    /**
     * 上传到本地
     * @param $file
     * @return bool|string
     */
    protected function local($file)
    {
        $result = false;
        try {
            $result = Filesystem::disk('public')->putFile('uploads', $file);
        } catch (\Exception $exception) {
            MsgContainer::msg($exception->getMessage());
        }

        if ($result) {
            $result = Config::get('filesystem.disks.public.url') . '/' . $result;
        }

        return $result;
    }

    /**
     * 上传到阿里云
     * @param $file
     * @return string
     */
    protected function aliyun($file)
    {
        return '';
    }
}