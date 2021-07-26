<?php

namespace magein\thinkphp_extra\table;

use think\migration\db\Table;

abstract class MTable
{
    /**
     * @param Table $table
     * @return mixed
     */
    abstract public function table(Table $table);
}