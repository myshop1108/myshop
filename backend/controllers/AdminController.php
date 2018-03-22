<?php

namespace backend\controllers;

use backend\models\Admin;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $admin=Admin::find()->all();
        return $this->render('index',compact('admin'));
    }
    public function actionLogin(){
        //生成一个表单模型
        $model=new Admin();
        $request=\Yii::$app->request;
        //判断是不是POST提交
        if($request->isPost){
            //数据绑定
            $model->load($request->post());
            //通过用户找出数据
            $admin = Admin::find()->where(['username' => $model->username])->one();
            //判断用户是否存在
            if($admin){
                if(($model->password==$admin->password)){
                    //通过user组件直接登录
                 // var_dump(  \Yii::$app->user->login($admin));exit;
                    //跳转首页
                    \Yii::$app->session->setFlash("success", "登录成功");
                    return $this->redirect(['admin/index']);
                }else{
                    $model->addError("password","密码错误");
                }
            }else{
                $model->addError('username','用户名不存在');
            }
        }

        //引入视图
        return $this->render('login',compact('model'));
    }
    public function actionLogout(){
        \Yii::$app->user->logout;
        return $this->goHome();
    }
    public function actionAdd()
    {
        //创建模型对象
        $model= new Admin();

        //判断是不是POST提交
        if (\Yii::$app->request->isPost) {
            //数据绑定
            $model->load(\Yii::$app->request->post());
            //后台验证
            if ($model->validate()) {
                // 验证成功，保存数据
                if ($model->save()) {
                    //跳转首页
                    \Yii::$app->session->setFlash("success","注册成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($model->errors);
                exit;
            }
        }
        return $this->render('add',compact('model'));
    }
    public function actionEdit($id)
    {
        //创建模型对象
        $model=Admin::findOne($id);

        //判断是不是POST提交
        if (\Yii::$app->request->isPost) {
            //数据绑定
            $model->load(\Yii::$app->request->post());
            //后台验证
            if ($model->validate()) {
                // 验证成功，保存数据
                if ($model->save()) {
                    //跳转首页
                    \Yii::$app->session->setFlash("success","注册成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($model->errors);
                exit;
            }
        }
        return $this->render('add',compact('model'));
    }
    public function actionDel($id)
    {
        //找到它并干掉它
        if (Admin::findOne($id)->delete()) {
            //跳转
            \Yii::$app->session->setFlash("success", "删除成功");
            return $this->redirect(['index']);
        }
    }
}
