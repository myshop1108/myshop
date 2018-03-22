<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 15:19
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{
    //1.设置属性
    public $username;
    public $password;
    public $rememberMe=true;
    //规则
    public function rules()
    {
        return [
            [['username','password'],'required'],
            [['rememberMe'],'safe']
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
        ];
    }


}