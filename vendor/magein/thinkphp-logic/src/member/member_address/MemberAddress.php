<?php

namespace magein\thinkphp_logic\member\member_address;

use magein\tools\common\Location;
use think\db\exception\DbException;
use magein\thinkphp_extra\traits\Instance;
use magein\thinkphp_extra\Logic;

class MemberAddress extends Logic
{
    use Instance;

    /**
     * 不
     * @var int
     */
    const IS_USE_NO = 0;

    /**
     * 是
     * @var int
     */
    const IS_USE_YES = 1;

    /**
     * @var array
     */
    protected $fields = [
        'id',
        'member_id',
        'nickname',
        'phone',
        'spare_phone',
        'province_id',
        'city_id',
        'area_id',
        'address',
        'house',
        'location',
        'tag',
        'is_use',
        'create_time',
    ];

    /**
     * @param mixed $is
     * @return array|string
     */
    public function transIsUse($is = null)
    {
        $data = [
            self::IS_USE_NO => '不',
            self::IS_USE_YES => '是',
        ];

        if (null !== $is) {
            return $data[$is] ?? '';
        }

        return $data;
    }

    /**
     * @param $phone
     * @return array|false|\think\Model|null
     */
    public function getByPhone($phone)
    {
        if (empty($phone)) {
            return false;
        }

        try {
            $record = $this->model()->where(['phone' => $phone])->find();
        } catch (DbException $exception) {
            $record = null;
        }

        return $record;
    }

    /**
     * 设置用户的收货地址
     * @param $member_id
     * @param array $data
     * @return bool|string
     */
    public function setMemberAddress($member_id, array $data = [])
    {
        if (empty($member_id)) {
            return false;
        }

        if (empty($data)) {
            $data = request()->post();
        }

        $region = $data['region'] ?? '';
        if ($region) {
            if (is_string($region)) {
                $region = explode(',', $region);
            }
            $data['province_id'] = $region[0] ?? '';
            $data['city_id'] = $region[1] ?? '';
            $data['area_id'] = $region[2] ?? '';
            unset($data['region']);
        }
        $data['member_id'] = $member_id;

        if (($data['is_use'] ?? 0) == 1) {
            $this->model()->where('member_id', $member_id)->save(['is_use' => self::IS_USE_NO]);
        }

        if ($data['location'] ?? '') {
            $data['location'] = (new Location($data['location']))->toString();
        }

        return $this->save($data, MemberAddressValidate::class);
    }

    /**
     * @param $member_id
     * @param false $is_use
     * @return mixed|\think\Collection|null
     */
    public function getListByMemberId($member_id, bool $is_use = false)
    {
        $model = $this->model();

        try {

            $result = $model->where('member_id', $member_id)->select();

            if ($is_use && $result) {
                foreach ($result as $item) {
                    if ($item->is_use == self::IS_USE_YES) {
                        $result = $item;
                        break;
                    }
                }
            }
        } catch (DbException $exception) {
            $result = null;
        }

        return $result;
    }
}