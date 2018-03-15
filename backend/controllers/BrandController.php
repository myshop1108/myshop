<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //找到所有数据
//        $brands=Brand::find()->all();
          $query=Brand::find();
          $count=$query->count();
          $page=new Pagination([
              'pageSize'=>1,
              'totalCount'=>$count
          ]);
        $brands=$query->offset($page->offset)->limit($page->limit)->all();
        return $this->render('index',compact('brands','page'));
    }
    public function actionAdd(){
        //创建模型对象
        $brands=new Brand();
        //创建request对象
        $request=\Yii::$app->request;
        //判断是不是POst提交
        if($request->isPost){
            //数据绑定
            $brands->load($request->post());
            //得到上传对象
            $brands->imgFile=UploadedFile::getInstance($brands,'imgFile');
            $imgPath="";
          //var_dump($brands->imgFile);exit;
            if ($brands->imgFile!==null){
                //定义文件上后保存的路径
                $imgPath="images/".time().".".$brands->imgFile->extension;
                // 移动临时文件到$imgPath中去
                $brands->imgFile->saveAs($imgPath,false);
                $brands->logo=$imgPath;

            }
            //后台验证
            if($brands->validate()){
                //验证成功
                if($brands->save()){
                    \Yii::$app->session->setFlash("success","添加成功");
                    return $this->redirect(['brand/index']);
                }else{
                    //打印
                    var_dump($brands->errors);exit;
                }
            }
        }
        //2.显示视图
        return $this->render('add',compact('brands'));
    }
    public function actionEdit($id){
        $brands=Brand::findOne($id);
        $request=\Yii::$app->request;
        //判断是不是POst提交
        if($request->isPost){
            //数据绑定
            $brands->load($request->post());
            //后台验证
            if($brands->validate()){
                //验证成功
                if($brands->save()){
                    \Yii::$app->session->setFlash("success","编辑成功");
                    return $this->redirect(['brand/index']);
                }else{
                    //打印
                    var_dump($brands->errors);exit;
                }
            }
        }
        //2.显示视图
        return $this->render('add',compact('brands'));
    }
    public function actionDel($id){
        if(Brand::findOne($id)->delete()){
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['brand/index']);
        }
    }

}
