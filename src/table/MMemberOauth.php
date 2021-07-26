<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MMemberOauth extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('会员授权信息表');
        $table->addColumn('member_id', 'integer', ['comment' => '编号']);
        $table->addColumn('open_id', 'string', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '财务类型 1 收入 increase 2 支出 decrease']);
        $table->addColumn('nickname', 'string', ['comment' => '昵称', 'default' => '']);
        $table->addColumn('sex', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '性别 0 保密 secret 1 男 man 2 女 woman', 'default' => 0]);
        $table->addColumn('avatar', 'string', ['comment' => '头像', 'default' => '']);
        $table->addColumn('province_id', 'integer', ['comment' => '省', 'default' => 0]);
        $table->addColumn('city_id', 'integer', ['comment' => '市', 'default' => 0]);
        $table->addColumn('area_id', 'integer', ['comment' => '县', 'default' => 0]);
        $table->addColumn('union_id', 'string', ['comment' => '唯一标识', 'default' => '']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->addIndex('open_id', ['name' => 'open_id', 'unique' => true]);
        $table->create();
    }
}