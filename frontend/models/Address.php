<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property string $name 姓名
 * @property string $province 省份
 * @property string $city 市
 * @property string $county 区县
 * @property string $adress 地址
 * @property string $mobile 手机号
 * @property int $status 状态:1 默认 0 非默认
 */
class Address extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['province','city','county','name','address'], 'required'],
            [['mobile'],'match','pattern'=>'/(13|14|15|17|18|19)[0-9]{9}/','message'=>'请输入正确的手机号'],
            [['status'],'safe']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'name' => '姓名',
            'province' => '省份',
            'city' => '市',
            'county' => '区县',
            'address' => '地址',
            'mobile' => '手机号',
            'status' => '状态:1 默认 0 非默认',
        ];
    }
}
