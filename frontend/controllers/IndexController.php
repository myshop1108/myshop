<?php

namespace frontend\controllers;

use backend\models\Categorry;
use backend\models\Goods;

class IndexController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionList($id){
        //通过分类ID得到当前分类对象
        $cate=Categorry::findOne($id);
        //通过分类Id找到所有子孙分类
        $sonCates=Categorry::find()->where(['tree'=>$cate->tree])->andWhere(['>=','lft',$cate->lft])->andWhere("rgt<={$cate->rgt}")->asArray()->all();
        //通过当前二维数组转化为一维数组
        $cateIds=array_column($sonCates,'id');
//        var_dump($cateIds);exit;

        //得到当前所有商品
        $goods=Goods::find()->where(['in','goods_category_id',$cateIds])->andWhere(['status'=>1])->orderBy('sort')->all();
//        var_dump($goods);exit;
        return $this->render('list',compact('goods'));
    }
    public function actionTest(){
        var_dump(\Yii::$app->controller->id."/".\Yii::$app->controller->action->id);
    }
}

