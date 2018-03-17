<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articl_content".
 *
 * @property int $id
 * @property string $detail 内容
 * @property int $article_id 文章ID
 */
class ArticlContent extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['detail'], 'string'],
            [['article_id'], 'integer'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail' => '内容',
            'article_id' => '文章ID',
        ];
    }
}
