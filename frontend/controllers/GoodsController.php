<?php

namespace frontend\controllers;

use backend\models\Categorry;
use backend\models\Goods;
use frontend\models\Cart;
use PHPUnit\Util\Log\JSON;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    /*
 * 商品详情
 */
    public function actionDetail($id){
//        var_dump($id);exit;
        $good=Goods::findOne($id);
        return $this->render('detail',compact('good'));
    }
    //添加购物车
    public function actionAddCart($id,$amount){
        //判断当前商品是否存在
        if (Goods::findOne($id)===null) {
            return $this->redirect(['index/index']);
        }
        if(\Yii::$app->user->isGuest){
            //未登录COOKIE
            //创建设置cookie对象
            $getCookie=\Yii::$app->response->cookies;
            //得到原来的购物车数据
            $cart=$getCookie->getValue('cart',[]);
            //判断当前添加的商品ID在购物车是否已经存在 执行＋新增
            if(array_key_exists($id,$cart)){
                //已经存在
                $cart[$id]+=$amount;
            }else{
                //新增
                $cart[$id] = (int)$amount;
            }
            //创建设置COokie对象
            $setCookie = \Yii::$app->response->cookies;
            //创建一个COokie对象
            $cookie = new Cookie([
                'name' => 'cart',
                'value' => $cart
            ]);
            //通过设置COokie对象来添加一个COokie
            $setCookie->add($cookie);
            return $this->redirect(['cart-list']);
        }else{
            //已经登录保存到数据库中
            //当前用户
            $userId=\Yii::$app->user->id;
            //判断当前用户有没有商品存在
            $cart=Cart::findOne(['goods_id'=>$id,'user_id'=>$userId]);
//            var_dump($cart);exit;
            //判断
            if($cart){
                //修改操作
                $cart->num+=$amount;
            }else{
                //创建对象
                //创建对象
                $cart=new Cart();
                //赋值
                $cart->goods_id=$id;
                $cart->num=$amount;
                $cart->user_id=$userId;
            }
            //保存
            $cart->save();
        }
        return $this->redirect(['cart-list']);
//        var_dump($id,$amount);
    }
    public function actionCartList(){
        // 判断登录
        if(\Yii::$app->user->isGuest){
            //从cookie中取出购物车数据
            $cart = \Yii::$app->request->cookies->getValue('cart', []);
//            var_dump($cart);exit;
            //取出$cart中的所有key值
            //  var_dump(array_keys($cart));exit;
            $goodIds = array_keys($cart);
            //取购物车的所有商品
            $goods = Goods::find()->where(['in', 'id', $goodIds])->all();
//              var_dump($goods);exit;
//        }else{
            //已登录 存入数据库

        }else{
//            var_dump(1111);exit;
//从cookie中取出购物车数据
            $cart=Cart::find()->where(['user_id'=>\Yii::$app->user->id])->all();
            //二维数组转换为一维数组
            $cart=ArrayHelper::map($cart,'goods_id','num');
//            var_dump($cart);exit;
            $goodsId=array_keys($cart);
            //取购物车中所有商品
            $goods=Goods::find()->where(['in','id',$goodsId])->all();
        }
        return $this->render('list',compact('goods','cart'));
    }
    public function actionUpdateCart($id,$amount){
        //取出购物车数据
        if(\Yii::$app->user->isGuest){
            //从cookie取出购物车数据
            $cart=\Yii::$app->request->cookies->getValue('cart',[]);
            //修改对应的数据
            $cart[$id]=$amount;
            //把cookie存到购物车中
            //创建设置COokie对象
            $setCookie = \Yii::$app->response->cookies;
            //创建一个COokie对象
            $cookie = new Cookie([
                'name' => 'cart',
                'value' => $cart
            ]);
            //通过设置COokie对象来添加一个COokie
            $setCookie->add($cookie);

        }
    }
    public function actionDelCart($id){
        //判断是否登录
        if(\Yii::$app->user->isGuest){
            //从cookie购物车中取出数据
            $cart = \Yii::$app->request->cookies->getValue('cart', []);
             //删除对应的数据
            unset($cart[$id]);
            //创建设置COokie对象
            $setCookie = \Yii::$app->response->cookies;
            //创建一个COokie对象
            $cookie = new Cookie([
                'name' => 'cart',
                'value' => $cart
            ]);
            //2.通过设置COokie对象来添加一个COokie
            $setCookie->add($cookie);
//            var_dump(\Yii::$app->user->id);exit;
           return \yii\helpers\Json::encode([
              'status'=>1,
               'msg'=>'删除成功'
           ]);
        }else{
            //登录状态下的删除i
            $cate=Cart::find()->where(['goods_id'=>$id,'user_id'=>\Yii::$app->user->id])->one()->delete();
            if($cate){
                return \yii\helpers\Json::encode([
                    'status'=>1,
                    'msg'=>'删除成功'
                ]);
            }


        }
    }
    public function actionTest(){
        $getCookie=\Yii::$app->request->cookies;
        var_dump($getCookie->getValue('cart'));
    }
}
