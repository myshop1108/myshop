<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int $goods_id 商品
 * @property string $amount 数量
 * @property int $member_id 用户ID
 */
class Cart extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['goods_id', 'amount', 'member_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品',
            'amount' => '数量',
            'member_id' => '用户ID',
        ];
    }
}
