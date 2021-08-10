<?php

namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

/**
 * 会员积分
 * Class MMemberIntegral
 * @package magein\thinkphp_extra\table
 */
class MMemberIntegral extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('会员积分日志');
        $table->addColumn('member_id', 'integer', ['comment' => '会员编号']);
        $table->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '积分类型 1 增加 increase 2 减少 decrease']);
        $table->addColumn('action', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '动作 11 注册 register 12 下单 order 22 支付订单 pay_order']);
        $table->addColumn('integral', 'integer', ['comment' => '积分']);
        $table->addColumn('before', 'integer', ['comment' => '前置积分 操作之间的金额']);
        $table->addColumn('order_no', 'string', ['comment' => '订单编号 每笔积分日志都要有对应的编号哪怕是虚拟的']);
        $table->addColumn('remark', 'string', ['comment' => '备注', 'default' => '']);
        $table->addColumn('oid', 'integer', ['comment' => '操作员']);
        $table->addColumn('otype', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '操作员 1 会员 member 2 管理员 manager']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->create();
    }
}