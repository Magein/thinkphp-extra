<?php


namespace magein\thinkphp_extra\table;

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;


class MAppQrCodeToken extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('应用程序扫码登录token值');
        $table->addColumn('token', 'char', ['limit' => 12, 'comment' => 'token值']);
        $table->addColumn('role', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '角色 1 管理员 admin 2 员工 employee']);
        $table->addColumn('expire_time', 'integer', ['comment' => '过期时间']);
        $table->addColumn('uuid', 'integer', ['comment' => '用户标识', 'default' => 0]);
        $table->addColumn('ip', 'string', ['comment' => 'IP地址', 'default' => '']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->addIndex('token', ['unique' => true, 'name' => 'token']);

        $table->create();
    }
}