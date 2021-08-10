<?php


namespace magein\thinkphp_extra\table;

use think\migration\db\Table;

class MAppIcon extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('应用程序图标管理器，建议放在云资源服务器');
        $table->addColumn('title', 'string', ['comment' => '图标说明']);
        $table->addColumn('name', 'string', ['comment' => '图标名称 只允许数字、字母、下划线']);
        $table->addColumn('icon', 'string', ['comment' => '图标地址']);
        $table->addColumn('remark', 'string', ['comment' => '备注', 'default' => '']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);

        $table->create();
    }
}