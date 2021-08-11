<?php

namespace magein\thinkphp_extra\oss\aliyun;

use OSS\Core\OssException;
use OSS\OssClient;

class AliYunOss
{
    private $client;

    private $bucket = '';

    /**
     * AliYunOss constructor.
     * @param AliYunOssData|null $aliYunOssData
     */
    public function __construct(AliYunOssData $aliYunOssData = null)
    {
        if ($aliYunOssData === null) {
            $aliYunOssData = new AliYunOssData();
        }

        try {
            $this->client = new OssClient(
                $aliYunOssData->getAccessKeyId(),
                $aliYunOssData->getAccessKeySecret(),
                $aliYunOssData->getEndpoint()
            );
            // 使用https
            $this->client->setUseSSL(true);
        } catch (OssException $exception) {
            $this->setError($exception->getMessage());
        }

        $this->bucket = $aliYunOssData->getBucket();
    }

    /**
     * @param string $file_path 本地文件的目录
     * @param string $object_name 保存到阿里云的目录
     * @param string $bucket
     * @return array|null
     */
    public function uploadFile($file_path, $object_name = '', $bucket = '')
    {
        if (empty($bucket)) {
            $bucket = $this->bucket;
        }

        if (empty($object_name)) {
            $object_name = pathinfo($file_path, PATHINFO_BASENAME);
        }
        $result = [];
        try {
            $result = $this->client->uploadFile($bucket, $object_name, $file_path);
        } catch (OssException $exception) {
            $this->setError($exception->getMessage());
        }

        return $result;
    }

    /**
     * @param $content
     * @param $object_name
     * @param string $bucket
     * @return array|null
     */
    public function uploadImageBase64($content, $object_name, $bucket = '')
    {
        if (empty($bucket)) {
            $bucket = $this->bucket;
        }

        $result = [];
        try {
            $result = $this->client->putObject($bucket, $object_name, $content);
        } catch (OssException $exception) {
            $this->setError($exception->getMessage());
        }

        return $result;
    }
}