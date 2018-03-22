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
use backend\models\Goodsgallery;
use backend\models\GoodsIntro;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class GoodsController extends Controller
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
        // 找到所有数据
//        $good=Goods::find()->all();
          $query=Goods::find();
          $minPrice=\Yii::$app->request->get('minPrice');
          $maxPrice=\Yii::$app->request->get('maxPrice');
          $keyword=\Yii::$app->request->get('keyword');
          $status=\Yii::$app->request->get('status');

          //加条件
        //最小值
        if($minPrice){
            $query->andWhere("shop_price>={$minPrice}");
        }
        //最大值
        if($maxPrice){
            $query->andWhere("shop_price<={$maxPrice}");
        }
        //商品和货号
        if($keyword!==""){
            $query->andWhere("name like '%{$keyword}%'or sn like '%{$keyword}%'");
        }
        if($status==="1" || $status==="2"){
            $query->andWhere(['status'=>$status]);
        }





        $count=$query->count();
        $page=new Pagination([
            'pageSize'=>3,
            'totalCount'=>$count
        ]);
        $good=$query->offset($page->offset)->limit($page->limit)->all();
        return $this->render('index',compact('good','page'));
    }
    public function actionAdd()
    {
        //创建模型对象
        $good = new Goods();
        //商品详情对象
        $intro=new GoodsIntro();

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
            //绑定商品详情的数据
            $intro->load(\Yii::$app->request->post());
            //后台验证
            if ($good->validate() && $intro->validate()) {
                $good->images;
                //判断sn，有没有值
                if($good->sn===null){
                    $dayTime=strtotime(date('Ymd'));
                    //找出当日商品数量
                    $count=Goods::find()->where(['>','inputtime','$dayTime'])->count();
                    //加1
                    $count+=1;
                    //取后面五位
                    $countstr=substr($count,'-5');
                    $good->sn=date('Ymd').$countstr;
                }
                // 验证成功，保存数据
                if ($good->save()) {
                    //操作商品内容
                    $intro->goods_id=$good->id;
                    $intro->save();
                    //多图操作 循环
                    foreach($good->images as $image){
                        $gallery=new Goodsgallery();
                        //赋值
                        $gallery->goods_id=$good->id;
                        $gallery->path=$image;
                        //保存图片
                        $gallery->save();
                    }
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
        return $this->render('add',compact('good','articlArr','categorryArr','intro'));
    }
    public function actionEdit($id)
    {
        //创建模型对象
        $good = Goods::findOne($id);
        //商品详情对象
//        $intro=GoodsIntro::findOne(['goods_id'=>'id']);
        $intro=GoodsIntro::findOne(['goods_id'=>$id]);
//        var_dump($intro);exit;
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
            //绑定商品详情的数据
            $intro->load(\Yii::$app->request->post());
            //后台验证
            if ($good->validate() && $intro->validate()) {
                $good->images;
                //判断sn，有没有值
                if($good->sn===null){
                    $dayTime=strtotime(date('Ymd'));
                    //找出当日商品数量
                    $count=Goods::find()->where(['>','inputtime','$dayTime'])->count();
                    //加1
                    $count+=1;
                    //取后面五位
                    $countstr=substr($count,'-5');
                    $good->sn=date('Ymd').$countstr;
                }
                // 验证成功，保存数据
                if ($good->save()) {
                    //操作商品内容
                    $intro->goods_id=$good->id;
                    $intro->save();
                    //多图操作 循环
                    foreach($good->images as $image){
                        $gallery=new Goodsgallery();
                        //赋值
                        $gallery->goods_id=$good->id;
                        $gallery->path=$image;
                        //保存图片
                        $gallery->save();
                    }
                    //跳转首页
                    \Yii::$app->session->setFlash("success","编辑成功");
                    return $this->redirect(['index']);
                }
            } else {
                //打印错误信息
                var_dump($good->errors);
                exit;
            }
        }
        $images=Goodsgallery::find()->where(['goods_id'=>$id])->asArray()->all();
        //把二维数组转一维数组
        $images=array_column($images,'path');
        $good->images=$images;
        // var_dump($articlArr);exit;
        return $this->render('add',compact('good','articlArr','categorryArr','intro'));
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