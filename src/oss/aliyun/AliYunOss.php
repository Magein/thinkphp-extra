<?php

namespace magein\thinkphp_extra\oss\aliyun;

use magein\thinkphp_extra\MsgContainer;
use OSS\Core\OssException;
use OSS\OssClient;

/**
 * 依赖阿里云sdk
 *
 * composer require aliyuncs/oss-sdk-php:"~^2.4"
 *
 * Class AliYunOss
 *
 * @package magein\thinkphp_extra\oss\aliyun
 */
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
            $this->client->setUseSSL($aliYunOssData->getUseSsl());
        } catch (OssException $exception) {
            MsgContainer::msg($exception->getMessage());
        }

        $this->bucket = $aliYunOssData->getBucket();
    }

    /**
     * @param string $file_path 本地文件的目录
     * @param string $object_name 保存到阿里云的目录和文件名称
     * @param string $ext 文件后缀
     * @return array|null
     */
    public function uploadFile($file_path, $object_name, $ext = '')
    {
        if (empty($this->bucket)) {
            return false;
        }

        if (empty($object_name)) {
            $object_name = date('YmdHi') . rand(1000, 9999);
        }

        $object_name .= '.' . $ext;
        $result = false;
        try {
            $result = $this->client->uploadFile($this->bucket, $object_name, $file_path);
        } catch (OssException $exception) {
            MsgContainer::msg($exception->getMessage());
        }

        return $result;
    }

    /**
     * 上传base64格式的文件到阿里云
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