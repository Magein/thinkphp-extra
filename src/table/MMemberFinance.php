<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MMemberFinance extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('会员财务日志');
        $table->addColumn('member_id', 'integer', ['comment' => '编号']);
        $table->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '财务类型 1 收入 increase 2 支出 decrease']);
        $table->addColumn('action', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '动作 11 充值 recharge 22 支付订单 pay_order']);
        $table->addColumn('money', 'decimal', ['comment' => '金额', 'precision' => 10, 'scale' => 2]);
        $table->addColumn('before', 'decimal', ['comment' => '前置金额 操作之间的金额', 'precision' => 10, 'scale' => 2, 'default' => 0]);
        $table->addColumn('order_no', 'string', ['comment' => '订单编号 每笔财务日志都要有对应的订单编号哪怕是虚拟的']);
        $table->addColumn('remark', 'string', ['comment' => '备注', 'default' => '']);
        $table->addColumn('oid', 'integer', ['comment' => '操作员']);
        $table->addColumn('otype', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '操作员 1 会员 member 2 管理员 manager']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->create();
    }
}