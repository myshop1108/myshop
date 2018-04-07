<?php

namespace frontend\controllers;





use frontend\components\ShopCart;
use frontend\models\Cart;
use frontend\models\User;
use Mrgoon\AliSms\AliSms;
use yii\helpers\Json;

class UserController extends \yii\web\Controller
{
//    public $enableCsrfValidational=false;
    public $layout=false;
    public function actions()
    {
        return [
            'code' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength'=>3,
                'maxLength'=>3,
//                'foreColor'=>'yellow'
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 用户注册
     */
    public function actionReg(){
        //判断是不是POS提交i
        $request=\Yii::$app->request;
        if($request->isPost){
//              exit('1111');
//            var_dump($request->post());exit;
        $user=new User();
        //给user绑定一个场景
            $user->setScenario('reg');
//        var_dump($user);exit;
        //数据绑定
        $user->load($request->post());
        //后台验证
         if($user->validate()){
             $user->auth_key=\Yii::$app->security->generateRandomString();
             //令牌
             $user->password_hash=\Yii::$app->security->generatePasswordHash($user->password);
             //新增用户
             if($user->save(false)) {
                 //跳转到登陆页面
                 $result=[
                     'status'=>1,
                     'msg'=>'注册成功',
                     'data'=>""
                 ];
                 return Json::encode($result);
             }
         }else{
             $result=[
                 'status'=>'0',
                 'msg'=>'注册失败',
                 'data'=>$user->errors,
             ];
             return Json::encode($result);
         }
//        $user->username=$request->post('username');
//        $user->password_hash=\Yii::$app->security->generatePasswordHash($request->post('password'));
//        $user->email=$request->post('email');
//        $user->mobile=$request->post('tel');
//        $user->save();
        }
        // 显示视图
        return $this->render('reg');
    }
    public function actionLogin(){
        $request=\Yii::$app->request;
        if($request->isPost){
            //绑定数据
            $model=new User();
            //引入场景
            $model->setScenario('login');
            $model->load($request->post());
//            var_dump($model->username);exit;
            //后台验证
            if($model->validate()) {
                // 用户对象
                $user = User::findOne(['username' => $model->username]);

                //判断用户是否存在
                if ($user) {

                    //判断密码是否正确
                    if ($user && \Yii::$app->security->validatePassword($model->password, $user->password_hash)) {

                        //用户登录
                        \Yii::$app->user->login($user,$model->rememberMe?3600**24*7:0);
                        //同步本地COOKIE中物购车到数据库中去
//                        (new ShopCart())->dbSyn()->flush()->save();
//                        //取出cookie中的数据
                       $cart=(new ShopCart())->get();
//                        //当前用户
                        $userId=\Yii::$app->user->id;
                        foreach ($cart as $goodId=>$num){
//                          //判断当前用户当前商品有没有存在
                      $cartDb=Cart::findOne(['goods_id'=>$goodId,'member_id'=>$userId]);
//                            //判断
                        if($cartDb){
                              $cartDb->amount+=$num;
                           }else{
//                                //创建对象
                           $cartDb=new Cart();
//                                //赋值
                              $cartDb->goods_id=$goodId;
                             $cartDb->amount=$num;
                             $cartDb->member_id=$userId;
                         }
//                            //保存
                          $cartDb->save();
//                            //清空本地Cookie中的数据
//
//                        }

                        //取出cookie的数据

                        //跳转到登陆页面
                        $result=[
                            'status'=>1  ,
                            'msg'=>'登录成功',
                            'data'=>""
                        ];
                        return Json::encode($result);
                    }else {
                        $model->addError('password','密码错误');
                        $result=[
                            'status'=>0  ,
                            'msg'=>'密码错误',
                            'data'=>$model->errors
                        ];
                        return Json::encode($result);
                    }
                }
            }
            $result=[
                'status'=>'0',
                'msg'=>'登录失败',
                'data'=>$model->errors,
            ];
            return Json::encode($result);

            //先找用户
            $user=User::findOne(['username'=>$request->post('username')]);


        }
        //引入视图
        return $this->render('login',compact('model'));
    }
    public function actionLogout(){
        if(\Yii::$app->user->logout()){
            return $this->redirect(['user/login']);
        }
    }
    public function actionSendSms($mobile){
        //生成随机验证码
        $code=rand(10000,99999);
        //把这个验证码发送给$mobile
        $config = [
            'access_key' => 'LTAI55qw38ifIZU3',
            'access_secret' => 'AjzInhacYhPbcFdWhSZw4MDcCh000I',
            'sign_name' => '管坤',
        ];

//        $aliSms = new Mrgoon\AliSms\AliSms();
        $aliSms=new AliSms();
        $response = $aliSms->sendSms($mobile, 'SMS_128875273', ['code'=> $code], $config);
        if ($response->Message=="OK"){
            //把code保存到Session中  把手机号当键名 验证码当值
            $session=\Yii::$app->session;
            $session->set("tel_".$mobile,$code);
            //测试
            //  return $code;
        }else{
            var_dump($response->Message);
        }

    }

}
