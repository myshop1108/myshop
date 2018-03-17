<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $intro 简介
 * @property int $status 状态
 * @property int $sort 排序
 * @property int $is_help 是不是帮助类
 */
class Category extends \yii\db\ActiveRecord
{
    public static $get=[1=>'是',2=>'否'];
    public static $post=[1=>'上线',2=>'下线'];
    public function rules()
    {
        return [
            [['name','sort','status','intro','is_help'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'is_help' => '是不是帮助类',
        ];
    }
}
