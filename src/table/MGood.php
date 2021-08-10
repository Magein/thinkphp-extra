<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MGood extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {

        $table->setComment('商品表');
        $table->addColumn('good_no', 'string', ['comment' => '商品编号']);
        $table->addColumn('title', 'string', ['comment' => '商品名称']);
        $table->addColumn('alias', 'string', ['comment' => '商品别名 内部使用如打印，报表等', 'default' => '']);
        $table->addColumn('cate_id', 'string', ['comment' => '商品分类', 'default' => '']);
        $table->addColumn('unit', 'string', ['comment' => '商品单位', 'default' => '']);
        $table->addColumn('intro', 'string', ['comment' => '商品简介', 'default' => '']);
        $table->addColumn('thumb', 'string', ['comment' => '商品缩略图', 'default' => '']);
        $table->addColumn('price', 'decimal', ['comment' => '销售价格', 'precision' => 10, 'scale' => 2]);
        $table->addColumn('market_price', 'decimal', ['comment' => '市场价格', 'precision' => 10, 'scale' => 2]);
        $table->addColumn('desc', 'string', ['comment' => '商品描述', 'default' => '']);
        $table->addColumn('spec', 'string', ['comment' => '商品规格 json形式 {规格id:{规格值id:规格id,规格值：规格id}}', 'default' => '']);
        $table->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '状态 0 下架 down 1 商家 up', 'default' => 1]);
        $table->addColumn('sort', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'comment' => '排序', 'default' => 99]);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->create();
    }
}