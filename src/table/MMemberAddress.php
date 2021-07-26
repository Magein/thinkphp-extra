<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MMemberAddress extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('会员收货地址');
        $table->addColumn('member_id', 'integer', ['comment' => '编号']);
        $table->addColumn('nickname', 'string', ['comment' => '收货人名称']);
        $table->addColumn('phone', 'string', ['comment' => '收货人号码']);
        $table->addColumn('spare_phone', 'string', ['comment' => '备用号码 收货人联系不上的时候可以联系的号码']);
        $table->addColumn('province_id', 'integer', ['comment' => '省', 'default' => '']);
        $table->addColumn('city_id', 'integer', ['comment' => '市', 'default' => '']);
        $table->addColumn('area_id', 'integer', ['comment' => '县', 'default' => '']);
        $table->addColumn('address', 'string', ['comment' => '所在地', 'default' => '']);
        $table->addColumn('tag', 'integer', ['comment' => '标签', 'default' => 0]);
        $table->addColumn('used', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '常用 0 不 no 1 是 yes', 'default' => 1]);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->create();
    }
}