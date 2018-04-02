<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id 会员ID
 * @property string $name 收货人
 * @property string $province_name 省份
 * @property string $city_name 城市
 * @property string $country_name 区县
 * @property string $detail_address 收货地址
 * @property string $tel 手机号
 * @property int $delivey_id 配送方式的ID
 * @property string $delivey_name 配送方式的名字
 * @property string $delivey_price 运费
 * @property int $pay_type_id 支付方式
 * @property string $price 商品金额
 * @property string $status  状态
 * @property int $trade_no 第三方支付的交易号
 * @property string $created_time 创建时间
 */
class Order extends \yii\db\ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '会员ID',
            'name' => '收货人',
            'province_name' => '省份',
            'city_name' => '城市',
            'country_name' => '区县',
            'detail_address' => '收货地址',
            'tel' => '手机号',
            'delivey_id' => '配送方式的ID',
            'delivey_name' => '配送方式的名字',
            'delivey_price' => '运费',
            'pay_type_id' => '支付方式',
            'price' => '商品金额',
            'status' => ' 状态',
            'trade_no' => '第三方支付的交易号',
            'created_time' => '创建时间',
        ];
    }
}
