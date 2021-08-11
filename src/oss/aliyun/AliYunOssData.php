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
}