<?php

namespace magein\thinkphp_extra;

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

/**
 * 添加create_time、update_time、delete_time字段信息
 * Class MigrateLogic
 * @package app\common\core\logic\extra
 */
class Migrate
{
    /**
     * @var Table $table
     */
    private $table;

    /**
     * 默认值
     * @var string
     */
    private $dv = null;

    /**
     * 长度
     * @var int
     */
    private $limit = 0;

    /**
     * 设置安全时间
     * @var bool
     */
    private $security_time = true;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    /**
     * 追加
     * @param $name
     * @param $type
     * @param array $options
     */
    public function append($name, $type, $options = [])
    {
        $this->table->addColumn($name, $type, $options);
    }

    /**
     * @param $value
     */
    public function setDefaultValue($value)
    {
        $this->dv = $value;

        return $this;
    }

    /**
     * @param $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * 关闭安全时间
     */
    public function closeSecurityTime()
    {
        $this->security_time = false;
    }

    /**
     * @param $options
     * @return array
     */
    private function getOption($options): array
    {
        if (is_string($options)) {
            $comment = $options;
            $options = [];
            $options['comment'] = $comment;
        }

        if ($this->dv !== null && empty($options['default'] ?? '')) {
            $options['default'] = $this->dv;
            $this->dv = null;
        }

        if ($this->limit && empty($options['limit'] ?? '')) {
            $options['limit'] = $this->limit;
            $this->limit = 0;
        }

        return $options;
    }

    /**
     * @param $name
     * @param string $options
     */
    public function setInt($name, $options = '')
    {
        $this->table->addColumn($name, 'integer', $this->getOption($options));
    }

    /**
     * @param $name
     * @param string $options
     */
    public function setTinyint($name, $options = '')
    {
        if (is_string($options)) {
            $options = [
                'comment' => $options,
                'limit' => MysqlAdapter::INT_TINY,
            ];
        }

        $this->table->addColumn($name, 'integer', $this->getOption($options));
    }

    /**
     * @param $name
     * @param string $options
     */
    public function setDecimal($name, $options = '')
    {
        if (is_string($options)) {
            $options = [
                'comment' => $options,
                'precision' => 10,
                'scale' => 2,
            ];
        }

        $this->table->addColumn($name, 'decimal', $this->getOption($options));
    }

    /**
     * @param $name
     * @param string $options
     */
    public function setString($name, $options = '')
    {
        if (is_string($options)) {
            $options = [
                'comment' => $options,
                'limit' => 255,
            ];
        }

        $this->table->addColumn($name, 'string', $this->getOption($options));
    }

    /**
     * @param $name
     * @param $limit
     * @param string $options
     */
    public function setChar($name, $limit, $options = '')
    {
        if (is_string($options)) {
            $options = [
                'comment' => $options,
                'limit' => $limit,
            ];
        }

        $this->table->addColumn($name, 'char', $this->getOption($options));
    }

    /**
     * 创建
     */
    public function create()
    {
        if ($this->security_time) {
            $this->setInt('create_time', '创建时间');
            $this->setInt('update_time', '更新时间');
            $this->setDefaultValue(0)->setInt('delete_time', '删除时间');
        }

        $this->table->create();
    }

    /**
     * 排序字段
     */
    public function sort($option = '排序')
    {
        $this->setDefaultValue(99)->setTinyint('sort', $option);
    }

    /**
     * 状态
     */
    public function scene($option = '场景', $default = 1)
    {
        $this->setDefaultValue($default)->setTinyint('scene', $option);
    }

    /**
     * 状态
     */
    public function status($option = '状态 0 禁用 forbid 1 启用 open')
    {
        $this->setDefaultValue(0)->setTinyint('status', $option);
    }

    /**
     * 审核
     * @param string $name
     * @param string $options
     */
    public function verify($name = 'status', $options = '状态 -1 拒绝 refuse 0 等待中 pending 1 通过 pass')
    {
        $this->setDefaultValue(0)->setTinyint($name, $options);
    }

    /**
     * 开始时间
     */
    public function startTime()
    {
        $this->setInt('start_time', '开始时间');
    }

    /**
     * 结束时间
     */
    public function endTime()
    {
        $this->setInt('end_time', '结束时间');
    }

    /**
     * 完成时间
     */
    public function completeTime()
    {
        $this->setDefaultValue(0)->setInt('complete_time', '完成时间');
    }

    /**
     * 创建手机号码
     * @param false $unique
     * @param string $options
     */
    public function phone($unique = false, $options = '手机号码')
    {
        $this->setChar('phone', 11, $options);

        if ($unique) {
            $this->unique('phone');
        }
    }

    /**
     * @param string $options
     */
    public function title($options = '标题')
    {
        $this->setLimit(30)->setInt('title', $options);
    }

    /**
     * 备注
     * @param string $options
     */
    public function remark($options = '备注')
    {
        $this->setDefaultValue('')->setString('remark', $options);
    }

    /**
     * 性别
     * @param string $options
     */
    public function sex($options = '性别 0 保密 secret 1 男 man 2 女 woman')
    {
        $this->setDefaultValue(0)->setTinyint('sex', $options);
    }

    /**
     * 普通索引
     * @param string|array $field
     * @param string $options
     */
    public function index($field, $options = '')
    {
        if (is_string($options)) {
            if (empty($options)) {
                $options = [];
                $name = $field;
            }
            $options['name'] = $name;
        }

        $this->table->addIndex($name, $options);
    }

    /**
     * 唯一索引
     * @param $field
     * @param string $options
     */
    public function unique($field, $options = '')
    {
        if (is_string($options)) {
            if (empty($options)) {
                $options = [];
                $name = $field;
            }
            $options['name'] = $name;
            $options['unique'] = true;
        }

        $this->table->addIndex($name, $options);
    }
}