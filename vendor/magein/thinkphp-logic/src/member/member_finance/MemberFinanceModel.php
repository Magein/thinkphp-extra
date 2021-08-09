<?php

namespace magein\thinkphp_logic\member\member_finance;

use magein\thinkphp_extra\Model;

/**
 * Class MemberFinanceModel
 * @package app\components\member\member_finance
 * @property integer $id
 * @property integer $member_id
 * @property integer $type
 * @property integer $action
 * @property float $money
 * @property float $before
 * @property string $order_no
 * @property string $remark
 * @property integer $oid
 * @property integer $otype
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $delete_time
 */
class MemberFinanceModel extends Model
{
    protected $table = 'member_finance';        
        
    protected $schema = [
        'id' => 'integer',
        'member_id' => 'integer',
        'type' => 'integer',
        'action' => 'integer',
        'money' => 'float',
        'before' => 'float',
        'order_no' => 'string',
        'remark' => 'string',
        'oid' => 'integer',
        'otype' => 'integer',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'delete_time' => 'integer',
    ];
    
    
    /**
     * @param $value
     * @param $data
     * @return array|string
     */                
    protected function getTypeTextAttr($value, $data)
    {
        return MemberFinance::instance()->transType($data['type'] ?? '');
    }

    /**
     * @param $value
     * @param $data
     * @return array|string
     */                
    protected function getActionTextAttr($value, $data)
    {
        return MemberFinance::instance()->transAction($data['action'] ?? '');
    }

    /**
     * @param $value
     * @param $data
     * @return array|string
     */                
    protected function getOtypeTextAttr($value, $data)
    {
        return MemberFinance::instance()->transOtype($data['otype'] ?? '');
    }
}    