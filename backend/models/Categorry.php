<?php

namespace backend\models;

use backend\components\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use PHPUnit\Runner\Filter\NameFilterIterator;
use Yii;

/**
 * This is the model class for table "categorry".
 *
 * @property int $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth 深度
 * @property string $name 名称
 * @property string $intro 简介
 * @property int $parent_id 父ID
 */
class Categorry extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'categorry';
    }    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
    public function rules()
    {
        return [
            [['name','intro'], 'required'],
            [['parent_id'], 'integer']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => '深度',
            'name' => '名称',
            'intro' => '简介',
            'parent_id' => '父ID',
        ];
    }
}
