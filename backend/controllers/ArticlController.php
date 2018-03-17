<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/17
 * Time: 13:27
 */

namespace backend\controllers;


use backend\models\Articl;
use backend\models\ArticlContent;
use backend\models\Category;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ArticlController extends Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    public function actionIndex(){
//        $articl=Articl::find()->all();
        $query=Articl::find();
        $count=$query->count();
        $page=new Pagination([
            'pageSize'=>3,
            'totalCount'=>$count
        ]);
        $articl=$query->offset($page->offset)->limit($page->limit)->all();
        return $this->render('index',compact('articl','page'));
    }
    public function actionAdd()
    {
        //创建模型对象
        $articl= new Articl();

        //创建文章内容模型对C象
        $content=new ArticlContent();

        //取到分类数据
        $articls=Category::find()->all();
        //把二位数组转一维数组
        $articlArr=ArrayHelper::map($articls,'id','name');
        //判断是不是POST提交
        $request=\Yii::$app->request;
        if ($request->isPost) {
            //数据绑定
            $articl->load($request->post());
            //后台验证
            if ($articl->validate()) {
                // 验证成功，保存数据
                if ($articl->save()) {
                    //保存文章内容
                    $content->load($request->post());
                    if($content->validate()){
                        //给文章赋值
                        $content->article_id=$articl->id;
                        //保存文章内容
                        if($content->save()){
                            \Yii::$app->session->setFlash('success','添加成功');
                            //跳转
                             return $this->redirect(['index']);
                        }
                    }
                }
            } else {
                //打印错误信息
                var_dump($articl->errors);
                exit;
            }
        }
        return $this->render('add',compact('articl','content','articlArr'));
    }
    public function actionEdit($id)
    {
        //创建模型对象
        $articl=Articl::findOne($id);
        //判断是不是POST提交
        if (\Yii::$app->request->isPost) {
            //数据绑定
            $articl->load(\Yii::$app->request->post());
            //后台验证
            if ($articl->validate()) {
                //验证成功，保存数据
                if ($articl->save()) {
                    //跳转首页
                    \Yii::$app->session->setFlash("success","编辑成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($articl->errors);
                exit;
            }
        }
        return $this->render('add',compact('articl'));
    }
    public function actionDel($id)
    {
        //找到它并干掉它
        if (Articl::findOne($id)->delete()) {
            //跳转
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }

}