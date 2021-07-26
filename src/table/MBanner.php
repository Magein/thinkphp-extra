<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MBanner extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('轮播图');
        $table->addColumn('title', 'string', ['comment' => '标题']);
        $table->addColumn('desc', 'string', ['comment' => '描述', 'default' => '']);
        $table->addColumn('redirect', 'string', ['comment' => '跳转地址', 'default' => '']);
        $table->addColumn('scene', 'string', ['comment' => '使用场景', 'default' => '']);
        $table->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '状态 0 禁用 forbid 1 启用 open', 'default' => 1]);
        $table->addColumn('start_time', 'integer', ['comment' => '开始时间']);
        $table->addColumn('end_time', 'integer', ['comment' => '结束时间']);
        $table->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '排序', 'default' => 99]);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);

        $table->create();
    }
}