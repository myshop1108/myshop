<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/19
 * Time: 15:14
 */

namespace backend\controllers;


use backend\models\Brand;
use backend\models\Categorry;
use backend\models\Goods;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class GoodsController extends Controller
{
    public function actionIndex(){
        // 找到所有数据
        $good=Goods::find()->all();
        return $this->render('index',compact('good'));
    }
    public function actionAdd()
    {
        //创建模型对象
        $good = new Goods();
        //取到品牌数据
        $brands=Brand::find()->asArray()->all();
        //var_dump($brands);exit;

//        echo "<pre>";
        //把二维数组转一维数组
        $articlArr=ArrayHelper::map($brands,'id','name');
        //取到分类数据
        $categorrys=Categorry::find()->orderBy("tree","lft","depth")->asArray()->all();
        //把二维数组转一维数组
        $arr=[];
       foreach ($categorrys as $categorry){
           $categorry["name"]=str_repeat("*",$categorry["depth"]*2).$categorry["name"];
           $arr[]=$categorry;
       }
       $categorryArr=ArrayHelper::map($arr,'id',"name");
        //判断是不是POST提交
        if (\Yii::$app->request->isPost) {
            //数据绑定
            $good->load(\Yii::$app->request->post());
            //后台验证
            if ($good->validate()) {
                // 验证成功，保存数据
                if ($good->save()) {
                    //跳转首页
                    \Yii::$app->session->setFlash("success","添加成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($good->errors);
                exit;
            }
        }
       // var_dump($articlArr);exit;
        return $this->render('add',compact('good','articlArr','categorryArr'));
    }
    public function actionEdit($id)
    {
        //创建模型对象
      $good=Goods::findOne($id);

        //判断是不是POST提交
        if (\Yii::$app->request->isPost) {
            //数据绑定
            $good->load(\Yii::$app->request->post());
            //后台验证
            if ($good->validate()) {
                // 验证成功，保存数据
                if ($good->save()) {
                    //跳转首页
                    \Yii::$app->session->setFlash("success","修改成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($good->errors);
                exit;
            }
        }
        return $this->render('add',compact('good'));
    }
    public function actionDel($id)
    {
        //找到它并干掉它
        if (Goods::findOne($id)->delete()) {
            //跳转
            \Yii::$app->session->setFlash("success", "删除成功");
            return $this->redirect(['index']);
        }
    }
    //上传图片
    public function actionUpload(){
        //通过name值得到文件上传对象
        $fileObj=UploadedFile::getInstanceByName('file');
//        var_dump($fileObj);exit;
        //移动临时文件到web目录
        if($fileObj!==null){
            //拼路径
            $filePath="images/".time().".".$fileObj->extension;
            //移动
            if($fileObj->saveAs($filePath,false)){
                //正确时
                //定义一个数组
                $ok=[
                    'code'=>0,
                    'url'=>"/".$filePath,//预览地址
                    "attachment"=>$filePath,

                ];
                //返回JSON数组
                return json_encode($ok);
            }
        }else{
            //错误时
            $result=[
                'code'=>1,
                'msg'=>"error"
            ];
            return json_encode($result);
        }
    }
}