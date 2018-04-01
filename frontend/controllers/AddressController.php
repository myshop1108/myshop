<?php

namespace frontend\controllers;

use frontend\models\Address;
use yii\helpers\Json;

class AddressController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //查出所有数据
        $addresss=Address::find()->where(['user_id'=>\Yii::$app->user->id])->all();
        return $this->render('index',compact('addresss'));
    }
    public function actionAdd(){
        //创建模型对象
        $model=new Address();
        //判断是不是POST提交
        if (\Yii::$app->request->isPost){
            //数据绑定
            $model->load(\Yii::$app->request->post());
            //后台验证
            if($model->validate()){
//                //给user_id重新赋值
                $model->user_id=\Yii::$app->user->id;
//                //给status重新赋值
                if ($model->status===null){
                    $model->status=0;
                }else{
                    //把其它状态设置0
                    Address::updateAll(['status'=>0],['user_id'=>$model->user_id]);
                    $model->status=1;
                }
                // 验证成功，保存数据
                if($model->save()){
                    $result= [
                        'status'=>1,
                        'msg'=>'保存成功',
                        'data'=>null
                    ];
                    return Json::encode($result);
                }
            }else{
                $result= [
                    'status'=>0,
                    'msg'=>'保存失败',
                    'data'=>$model->errors
                ];
                return Json::encode($result);
            }

        }

    }
    public function actionDel($id){
        if (Address::findOne(['id'=>$id,'user_id'=>\Yii::$app->user->id])->delete()) {
            return $this->redirect('index');
        }
    }
}
