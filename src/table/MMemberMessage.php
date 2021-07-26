<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MMemberMessage extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('会员消息通知');
        $table->addColumn('member_id', 'integer', ['comment' => '编号']);
        $table->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '消息 1 系统消息 system 2 财务消息 finance']);
        $table->addColumn('title', 'string', ['comment' => '消息标题']);
        $table->addColumn('content', 'text', ['comment' => '内容']);
        $table->addColumn('read_time', 'integer', ['comment' => '阅读时间', 'default' => 0]);
        $table->addColumn('keyword', 'string', ['comment' => '关键信息 json形式，如{text:订单编号,value:"order123"}', 'default' => 0]);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->create();
    }
}