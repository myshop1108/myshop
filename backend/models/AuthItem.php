<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class AuthItem extends \yii\db\ActiveRecord
{
    //定义声明一个属性来存放所有属性
    public $permissions;


    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'],'unique'],
            [['description','permissions'],'safe']
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'description' => '描述',
            'permissions'=>'权限列表'
        ];
    }
}
