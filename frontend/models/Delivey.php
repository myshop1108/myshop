<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "delivey".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $price 运费
 * @property string $intro 简介
 */
class Delivey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivey';
    }

    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'price' => '运费',
            'intro' => '简介',
        ];
    }
}
