<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_intro".
 *
 * @property int $id
 * @property int $goods_id 商品ID
 * @property string $content 商品内容
 */
class GoodsIntro extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['content'], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品ID',
            'content' => '商品内容',
        ];
    }
}
