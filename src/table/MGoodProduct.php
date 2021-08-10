<?php


namespace magein\thinkphp_extra\table;


use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\db\Table;

class MGoodProduct extends MTable
{
    /**
     * @param \think\migration\db\Table $table
     * @return mixed|void
     */
    public function table(Table $table)
    {
        $table->setComment('货品表');
        $table->addColumn('product_no', 'string', ['comment' => '货品编号']);
        $table->addColumn('good_id', 'string', ['comment' => '商品编号']);
        $table->addColumn('svi', 'string', ['comment' => '规格值id svi=spec_value_id']);
        $table->addColumn('svt', 'string', ['comment' => '规格值 svt=spec_value_text']);
        $table->addColumn('sign', 'string', ['comment' => '规格标记 svi相加的结果用于匹配']);
        $table->addColumn('thumb', 'string', ['comment' => '缩略图', 'default' => '']);
        $table->addColumn('price', 'decimal', ['comment' => '价格', 'precision' => 10, 'scale' => 2]);
        $table->addColumn('market_price', 'decimal', ['comment' => '市场价格', 'precision' => 10, 'scale' => 2]);
        $table->addColumn('stock', 'integer', ['comment' => '剩余库存', 'default' => 0]);
        $table->addColumn('size', 'string', ['comment' => '尺寸', 'default' => '']);
        $table->addColumn('weight', 'string', ['comment' => '重量', 'default' => '']);
        $table->addColumn('create_time', 'integer', ['comment' => '创建时间']);
        $table->addColumn('update_time', 'integer', ['comment' => '更新时间']);
        $table->addColumn('delete_time', 'integer', ['comment' => '删除时间', 'default' => 0]);
        $table->addIndex(['product_no' => ['unique' => true, 'name' => 'product_no']]);
        $table->create();
    }
}