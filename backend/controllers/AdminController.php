<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/22
 * Time: 14:17
 */

namespace backend\controllers;


use backend\models\Admin;
use backend\models\AuthItem;
use backend\models\LoginForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $admin=Admin::find()->all();
        return $this->render('index',compact('admin'));
    }
    public function actionLogin(){
        //生成一个表单模型
        $model=new LoginForm();
        $request=\Yii::$app->request;
        //判断是不是POST提交
        if($request->isPost){
//                  var_dump($request->isPost);exit;
            //数据绑定
            $model->load($request->post());
//            var_dump($request->post());exit;
            //后台验证
            if($model->validate()){
                //通过用户名找到用户对象
                $admin=Admin::findOne(['username'=>$model->username]);

                //判断用户是否存在
                if($admin && $admin->status!=0){

                    //验证密码
                    if(\Yii::$app->security->validatePassword($model->password,$admin->password)){
                        // 密码验证成功登录
                        \Yii::$app->user->login($admin);
                        //设置登录时间
                        $admin->login_at=time();
                        //用户Ip
                        $admin->login_ip=ip2long(\Yii::$app->request->userIP);
                        //更新用户信息
                        if($admin->save()){
                            \Yii::$app->session->setFlash('success','登录成功');
                            return $this->redirect(['goods/index']);
                        }

                    }else{

                        //密码错误
                        $model->addError('password','用户密码错误');
                    }
                }else{
                    //用户不存在或已禁用
                    $model->addError('username','用户不存在或已禁用');
                }

            }else{
                //打印错误
                var_dump($model->errors);exit;
            }

        }
        //引入视图
        return $this->render('login',compact('model'));
    }
    public function actionLogout(){
       \Yii::$app->user->logout();
        return $this->redirect('login');
    }
    public function actionAdd()
    {
        //创建模型对象
        $model= new Admin();
        $model->setScenario("add");
        $auth_item=new AuthItem();
        $auth=\Yii::$app->authManager;
        $pers=$auth->getRoles();
        $persArr=ArrayHelper::map($pers,'name','name');
        //判断是不是POST提交
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $auth_item->load(\Yii::$app->request->post());
            //给密码加密
//            echo $model->password;exit;
            $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            //设置令牌 随机字符串
            $model->auth_key = \Yii::$app->security->generateRandomString();
            //后台验证
            // 验证成功，保存数据
            if ($model->save()) {
                //实例化对象
                $auth=\Yii::$app->authManager;

                $roles=$auth->getRole($auth_item->name);
                // 指派用户id
                $auth->assign($roles,$model->id);

//跳转首页
                \Yii::$app->session->setFlash("success", "添加成功");
                return $this->redirect(['index']);
            }else{
                var_dump($model->errors);exit;
            }



//
//            echo $model->status;echo "<br/>";
//            echo $model->password;exit;
        }
            return $this->render('add', compact('model','auth_item','persArr'));
    }





    public function actionEdit($id)
    {
        //创建模型对象
        $model=Admin::findOne($id);
        $password=$model->password;
        $model->setScenario("edit");
        //判断是不是POST提交
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if($model->password){
                //给密码加密
                $model->password = \Yii::$app->security->generatePasswordHash($model->password);
            }else{
                $model->password=$password;
            }
            //设置令牌 随机字符串
//            $model->auth_key = \Yii::$app->security->generateRandomString();
            //后台验证
            // 验证成功，保存数据
            if ($model->save()) {
                //跳转首页
                \Yii::$app->session->setFlash("success", "编辑成功");
                return $this->redirect(['index']);
            }
        }
        $model->password=null;
        return $this->render('add', compact('model'));
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