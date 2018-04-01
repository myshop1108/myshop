<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //创建auth对象
        $auth=\Yii::$app->authManager;
        //找到所有权限
        $roles=$auth->getRoles();
        return $this->render('index',compact('roles'));
    }
    public function actionAdd(){
        //创建模型对象
         $model=new AuthItem();
        //创建auth对象
        $auth=\Yii::$app->authManager;
        //得到所有权限
        $pers=$auth->getPermissions();
//        var_dump($pers);exit;
        $persArr=ArrayHelper::map($pers,'name','description');
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //创建角色对象
            $role=$auth->createRole($model->name);
            // 设置描述
            $role->description=$model->description;
//            var_dump($role);exit;
            //角色入库
            if($auth->add($role)){
                //判断有没有权限
                if($model->permissions){
                    //给当前角色添加权限   循环取出权限并添加给角色
                    foreach ($model->permissions as $perName){
                        //通过权限名称得权限对象
                        $per=$auth->getPermission($perName);
                        //给角色添加权限
                        $auth->addChild($role,$per);
                    }
                }
                \Yii::$app->session->setFlash('success','角色'.$model->name.'添加成功');
                //跳转
                return $this->redirect(['role/index']);

            }
        }
        else{
//            var_dump($model->errors);exit;

        }
        //视图
        return $this->render('add',compact('model','persArr'));
    }



    public function actionEdit($name){
        // 创建模型对象
        $model=AuthItem::findOne($name);
        //创建auth对象
        $auth=\Yii::$app->authManager;
        //得到所有权限
        $pers=$auth->getPermissions();
        $persArr=ArrayHelper::map($pers,'name','description');
        //得到当前角色所对应的所有权限
        $rolePers=$auth->getPermissionsByRole($name);
        $model->permissions=array_keys($rolePers);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()){
            //创建auth对象
            //得到角色
            $role=$auth->getRole($model->name);
            //设置描述
            $role->description=$model->description;
            //更新角色
            if ($auth->update($model->name,$role)) {
                //删除当前角色对应的所有权限
                $auth->removeChildren($role);
                //判断有没有添加权限
                if ($model->permissions){
                    //给当前角色添加权限   循环取出权限并添加给角色
                    foreach($model->permissions as $perName){
                        //通过权限名称得权限对象
                        $per=$auth->getPermission($perName);
                        //给角色添加权限
                        $auth->addChild($role,$per);
                    }
                }
                //提示
                \Yii::$app->session->setFlash('success','角色'.$model->name.'修改成功');
                //刷新
                return $this->redirect(['index']);
            }
        }
        else{
            //var_dump($model->errors);exit;
        }
        //视图
        return $this->render('edit',compact('model','persArr'));
    }


//角色删除
    public function actionDel($name){
        //创建auth对象
        $auth=\Yii::$app->authManager;
        //找到角色
        $role=$auth->getRole($name);
        if ($auth->remove($role)) {
            \Yii::$app->session->setFlash('success','删除'.$name.'成功');
            return $this->redirect(['index']);
        }
    }
    //把用户添加一个角色
    public function actionAdminRole($roleName,$id){
        //实例化组件对象
        $auth=\Yii::$app->authManager;
        //通过角色名称找出角色对象
        $role=$auth->getRole($roleName);
        //把用户指派给角色
        var_dump($auth->assign($role,$id));
    }
    //判断当前登录用户有没有权限
    public function actionCheck(){
        //检测当前用户有没有权限
        var_dump(\Yii::$app->user->can('goods/add'));
    }

}
