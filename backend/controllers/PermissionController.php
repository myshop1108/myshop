<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //创建auth对象
        $auth=\Yii::$app->authManager;
        //2 找到所有权限
        $pers=$auth->getPermissions();
        return $this->render('index',compact('pers'));
    }
    public function actionAdd(){
        //创建模型对象
         $model=new AuthItem();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //创建权限对象
            $auth=\Yii::$app->authManager;
            //创建权限
            $per=$auth->createPermission($model->name);
            // 设置描述
            $per->description=$model->description;
            //权限入库
            if($auth->add($per)){
                \Yii::$app->session->setFlash('success','权限'.$model->name.'添加成功');
                //跳转
                return $this->redirect(['permission/index']);

            }
        }
        else{
//            var_dump($model->errors);exit;

        }
        //视图
        return $this->render('add',compact('model'));
    }



    public function actionEdit($name){
        //创建模型对象
        $model=AuthItem::findOne($name);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //创建权限对象
            $auth=\Yii::$app->authManager;
            //创建权限
            $per=$auth->getPermission($model->name);
            // 设置描述
            $per->description=$model->description;
            //权限入库
            if($auth->update($model->name,$per)){
                \Yii::$app->session->setFlash('success','权限'.$model->name.'修改成功');
                //跳转
                return $this->redirect(['permission/index']);

            }
        }
        else{
//            var_dump($model->errors);exit;

        }
        //视图
        return $this->render('edit',compact('model'));
    }



    //权限删除
    public function actionDel($name){
        //创建auth对象
        $auth=\Yii::$app->authManager;
        //找到权限
        $per=$auth->getPermission($name);
        if ($auth->remove($per)) {
            \Yii::$app->session->setFlash('success','删除'.$name.'成功');
            return $this->redirect(['index']);
        }

    }

}
