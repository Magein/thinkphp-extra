<?php

namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

/**
 * 会员积分
 * Class MMemberIntegral
 * @package magein\thinkphp_extra\table
 */
class MMemberCoupon extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('会员优惠券');
        $table->addColumn('member_id', 'integer', ['comment' => '会员编号']);
        $table->addColumn('form', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '来源 1 系统发送 system 11 活动营销']);
        $table->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '类型 1 满减券 full 2 兑换券 exchange']);
        $table->addColumn('title', 'string', ['comment' => '优惠券标题']);
        $table->addColumn('desc', 'string', ['comment' => '优惠券描述', 'default' => '']);
        $table->addColumn('sign', 'string', ['comment' => '标记 防止重复发放的标记']);
        $table->addColumn('money', 'decimal', ['comment' => '金额', 'precision' => 10, 'scale' => 2]);
        $table->addColumn('min', 'decimal', ['comment' => '使用金额 最小的使用金额', 'precision' => 10, 'scale' => 2]);
        $table->addColumn('use_time', 'integer', ['comment' => '使用时间', 'default' => 0]);
        $table->addColumn('start_time', 'integer', ['comment' => '开始时间', 'default' => 0]);
        $table->addColumn('end_time', 'integer', ['comment' => '结束时间', 'default' => 0]);
        $table->addColumn('order_no', 'string', ['comment' => '订单编号 优惠券用在那个订单上面了']);
        $table->addColumn('allow_good_id', 'string', ['comment' => '允许使用的商品id', 'default' => '']);
        $table->addColumn('forbid_good_id', 'string', ['comment' => '不允许使用的商品id', 'default' => '']);
        $table->addColumn('remark', 'string', ['comment' => '优惠券备注', 'default' => '']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->addIndex('member_id');
        $table->create();
    }
}