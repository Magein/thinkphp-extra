<?php


namespace magein\thinkphp_extra\table;

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MMember extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('会员表');
        $table->addColumn('username', 'string', ['comment' => '登录账号']);
        $table->addColumn('password', 'string', ['comment' => '密码']);
        $table->addColumn('phone', 'string', ['comment' => '手机号码']);
        $table->addColumn('nickname', 'string', ['comment' => '昵称', 'default' => '']);
        $table->addColumn('email', 'string', ['comment' => '邮箱地址', 'default' => '']);
        $table->addColumn('sex', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '性别 0 保密 secret 1 男 man 2 女 woman', 'default' => 0]);
        $table->addColumn('age', 'integer', ['comment' => '年龄', 'default' => 0]);
        $table->addColumn('money', 'decimal', ['comment' => '总消费金额', 'precision' => 10, 'scale' => 2, 'default' => 0]);
        $table->addColumn('balance', 'decimal', ['comment' => '余额', 'precision' => 10, 'scale' => 2, 'default' => 0]);
        $table->addColumn('province_id', 'integer', ['comment' => '省', 'default' => 0]);
        $table->addColumn('city_id', 'integer', ['comment' => '市', 'default' => 0]);
        $table->addColumn('area_id', 'integer', ['comment' => '县', 'default' => 0]);
        $table->addColumn('address', 'string', ['comment' => '所在地', 'default' => '']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->addIndex('username', ['name' => 'username', 'unique' => true]);
        $table->addIndex('phone', ['name' => 'phone', 'unique' => true]);
        $table->create();
    }
}