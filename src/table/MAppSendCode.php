<?php


namespace magein\thinkphp_extra\table;

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;


class MAppSendCode extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('发送手机验证码');
        $table->addColumn('phone', 'char', ['limit' => 11, 'comment' => '手机号码']);
        $table->addColumn('scene', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '发送场景 1 注册 register 2 验证 verify']);
        $table->addColumn('code', 'string', ['comment' => '验证码']);
        $table->addColumn('expire_time', 'integer', ['comment' => '过期时间']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->addIndex('phone');

        $table->create();
    }
}