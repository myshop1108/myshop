<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property int $id
 * @property int $order_info-id 订单ID
 * @property int $goods_id 商品ID
 * @property string $goods_name 商品名称
 * @property string $logo LOGO
 * @property string $price 价格
 * @property int $amount 数量
 * @property string $total_price 小计
 */
class OrderDetail extends \yii\db\ActiveRecord
{
public $amount;
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_info-id' => '订单ID',
            'goods_id' => '商品ID',
            'goods_name' => '商品名称',
            'logo' => 'LOGO',
            'price' => '价格',
            'amount' => '数量',
            'total_price' => '小计',
        ];
    }
}
