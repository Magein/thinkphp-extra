<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MGoodUnit extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {

        $table->setComment('商品单位');
        $table->addColumn('title', 'string', ['comment' => '单位名称']);
        $table->addColumn('desc', 'string', ['comment' => '单位描述', 'default' => '']);
        $table->addColumn('icon', 'string', ['comment' => '单位图标', 'default' => '']);
        $table->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '状态 0 禁用 forbid 1 启用 open', 'default' => 1]);
        $table->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '排序', 'default' => 99]);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);

        $table->create();
    }
}