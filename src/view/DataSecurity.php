<?php
/**
 * Created by PhpStorm.
 * User: xiaomage
 * Date: 2020/12/11
 * Time: 13:34
 */

namespace magein\thinkphp_extra\view;

class DataSecurity
{
    /**
     * 使用的模型
     * @var string
     */
    protected $logic = '';

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
    protected $fields = [];

    /**
     * @return string
     */
    public function getLogic(): string
    {
        return $this->logic;
    }

    /**
     * @param string $logic
     */
    public function setLogic(string $logic)
    {
        $this->logic = $logic;
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
            $this->put = is_array($post) ? $post : [$post];
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
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $query
     */
    public function setFields(array $query = [])
    {
        if ($query) {
            $this->query = is_array($query) ? $query : [$query];
        }
    }
}

