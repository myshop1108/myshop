<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16
 * Time: 20:26
 */

namespace backend\controllers;


use backend\models\Category;
use yii\data\Pagination;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex(){
        //找到所有数据
//       $cate=Category::find()->all();
        $query=Category::find();
        $count=$query->count();
        $page=new Pagination([
            'pageSize'=>1,
            'totalCount'=>$count
        ]);
        $cate=$query->offset($page->offset)->limit($page->limit)->all();
        //返回视图
        return $this->render('index',compact('cate','page'));
    }
    public function actionAdd()
    {
        //创建模型对象
        $cate = new Category();

        //判断是不是POST提交
        if (\Yii::$app->request->isPost) {
            //数据绑定
            $cate->load(\Yii::$app->request->post());
            //后台验证
            if ($cate->validate()) {
                // 验证成功，保存数据
                if ($cate->save()) {
                    //跳转首页
                    \Yii::$app->session->setFlash("success","添加成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($cate->errors);
                exit;
            }
        }
        return $this->render('add',compact('cate'));
    }
    public function actionEdit($id)
    {
        //创建模型对象
        $cate=Category::findOne($id);
        //判断是不是POST提交
        if (\Yii::$app->request->isPost) {
            //数据绑定
            $cate->load(\Yii::$app->request->post());
            //后台验证
            if ($cate->validate()) {
                //验证成功，保存数据
                if ($cate->save()) {
                    //跳转首页
                    \Yii::$app->session->setFlash("success","编辑成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($cate->errors);
                exit;
            }
        }
        return $this->render('add',compact('cate'));

    }
    public function actionDel($id)
    {
        //找到它并干掉它
        if (Category::findOne($id)->delete()) {
            //跳转
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }

}