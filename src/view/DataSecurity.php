<?php
/**
 * Created by PhpStorm.
 * User: xiaomage
 * Date: 2020/12/11
 * Time: 13:34
 */

namespace magein\thinkphp_extra\view;

use think\Exception;

class DataSecurity
{
    /**
     * 自动设置fields信息
     * @var array
     */
    protected $fields = [];

    /**
     * 使用的模型类
     * @var string
     */
    protected $model = '';

    /**
     * 允许新增的数据字段
     * @var array
     */
    protected $post = [];

    /**
     * 允许更新的数据字段
     * @var array
     */
    protected $put = [];

    /**
     * 查询的query参数
     * @var array
     */
    protected $query = [];

    /**
     * 暴露给前端的字段
     * @var array
     */
    protected $export = [];

    /**
     * 受保护的字段
     * @var array
     */
    protected $protected = ['update_time', 'delete_time'];

    /**
     * @return string|\think\Model
     */
    public function getModel($instance = true)
    {
        $model = $this->model;

        if ($model && class_exists($model)) {
            $model = new $model();
        }

        return $model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model)
    {
        $this->model = $model;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * @param array|string $post
     */
    public function setPost($post = [])
    {
        if ($post) {
            $this->post = is_array($post) ? $post : [$post];
        }
    }

    /**
     * @return array
     */
    public function getPut(): array
    {
        return $this->put;
    }

    /**
     * @param array|string $put
     */
    public function setPut($put = [])
    {
        if ($put) {
            $this->put = is_array($put) ? $put : [$put];
        }
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @param array $query
     */
    public function setQuery(array $query = [])
    {
        if ($query) {
            $this->query = is_array($query) ? $query : [$query];
        }
    }

    /**
     * @return array
     */
    public function getProtected(): array
    {
        return $this->protected;
    }

    /**
     * @return array
     */
    public function getExport(): array
    {
        return $this->export;
    }

    /**
     * @param array $export
     */
    public function setExport(array $export = [])
    {
        if ($export) {
            $this->export = is_array($export) ? $export : [$export];
        }
    }

    public function setFields()
    {
        if ($this->fields) {
            $post = $this->fields;
            unset($post[array_search('post', $post)], $post[array_search('create_time', $post)]);
            $this->setPost($post);
            $this->setPut($post);
            $this->setExport($this->fields);
            $this->setQuery($this->fields);
        }
    }
}

