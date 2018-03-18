<?php

namespace backend\controllers;

use backend\models\Categorry;
use PHPUnit\Util\Log\JSON;
use yii\data\ActiveDataProvider;

class CategorryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Categorry::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $this->render('index',compact('dataProvider'));
    }

    /**
     * @return string
     */
    public function actionAdd(){
        $cate=new Categorry();
        //查询所有分类
        $cates=Categorry::find()->all();
        $cates[]=['id'=>0,'name'=>'一级分类','parent_id'=>0];
        $catesJson=\yii\helpers\Json::encode($cates);
        //post
        $request=\Yii::$app->request;
        if($request->isPost){
            //数据绑定
            $cate->load($request->post());
            //后台验证
            if($cate->validate()) {
                //添加一级分类
                if ($cate->parent_id == 0) {
                    //创建一个一级分类
                    $cate->makeRoot();
                    \Yii::$app->session->setFlash("success","创建一级父类:".$cate->name."成功");

                    //刷新
                    return $this->refresh();
                } else {
                    //添加子类
                    //创建一个新的分类
                    $cateParent=Categorry::findOne($cate->parent_id);
                    //把新的分类加到父分类中
                    $cate->prependTo($cateParent);
                    \Yii::$app->session->setFlash("success","创建{$cateParent->name}分类的字类:".$cate->name."成功");
                    //刷新
                    return $this->refresh();
                }
                var_dump($cate->errors);
                exit;
            }
            }
        return $this->render('add',compact('cate','catesJson'));
        //创建一个一级分类;

    }
    public function actionUpdate($id){
        $cate=Categorry::findOne($id);
        $cates[]=['id'=>0,'name'=>'一级分类','parent_id'=>0];
        $catesJson=\yii\helpers\Json::encode($cates);
        //post
        $request=\Yii::$app->request;
        if($request->isPost){
            //数据绑定
            $cate->load($request->post());
            //后台验证
            if($cate->validate()) {
                //添加一级分类
                if ($cate->parent_id == 0) {
                    //创建一个一级分类
                    $cate->makeRoot();
                    \Yii::$app->session->setFlash("success","创建一级父类:".$cate->name."成功");
                    //刷新
                    return $this->refresh();
                } else {
                    //添加子类
                    //创建一个新的分类
                    $cateParent=Categorry::findOne($cate->parent_id);
                    //把新的分类加到父分类中
                    $cate->prependTo($cateParent);
                    \Yii::$app->session->setFlash("success","创建{$cateParent->name}分类的字类:".$cate->name."成功");
                    //刷新
                    return $this->refresh();
                }
                var_dump($cate->errors);
                exit;
            }
        }
        return $this->render('add',compact('cate','catesJson'));
        //创建一个一级分类;

    }
    public function actionDelete($id)
    {
        $del=Categorry::findOne($id)->delete();
        //找到它并干掉它
        if ($del) {
            //跳转
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }


}
