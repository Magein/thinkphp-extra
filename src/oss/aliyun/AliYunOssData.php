<?php

namespace magein\thinkphp_extra\oss\aliyun;


class AliYunOssData
{
    /**
     * @var string
     */
    private $access_key_id = '';

    /**
     * @var string
     */
    private $access_key_secret = '';

    /**
     * @var string
     */
    private $endpoint = '';

    /**
     * @var string
     */
    private $bucket = '';

    /**
     * 使用https
     * @var bool
     */
    private $use_ssl = true;

    /**
     * 保存的路径
     * @var string
     */
    private $save_path = '';

    /**
     * 保存的名称
     * @var string
     */
    private $save_name = '';

    /**
     * @return string
     */
    public function getAccessKeyId(): string
    {
        return $this->access_key_id;
    }

    /**
     * @param string $access_key_id
     */
    public function setAccessKeyId(string $access_key_id): void
    {
        $this->access_key_id = $access_key_id;
    }

    /**
     * @return string
     */
    public function getAccessKeySecret(): string
    {
        return $this->access_key_secret;
    }

    /**
     * @param string $access_key_secret
     */
    public function setAccessKeySecret(string $access_key_secret): void
    {
        $this->access_key_secret = $access_key_secret;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * @param string $bucket
     */
    public function setBucket(string $bucket)
    {
        $this->bucket = $bucket;
    }

    /**
     * @return bool
     */
    public function getUseSsl(): bool
    {
        return $this->use_ssl;
    }

    /**
     * @param bool $use_ssl
     */
    public function setUseSsl(bool $use_ssl): void
    {
        $this->use_ssl = $use_ssl;
    }

    /**
     * @return string
     */
    public function getSavePath(): string
    {
        if (empty($this->save_path)) {
            $this->save_path = 'uploads';
        }

        return $this->save_path;
    }

    /**
     * @param string $save_path
     */
    public function setSavePath(string $save_path): void
    {
        $this->save_path = $save_path;
    }

    /**
     * @return string
     */
    public function getSaveName(): string
    {
        if (empty($this->save_name)) {
            $this->save_name = date('YmdHi');
        }

        return $this->save_name;
    }

    /**
     * @param string $save_name
     */
    public function setSaveName(string $save_name): void
    {
        $this->save_name = $save_name;
    }
}