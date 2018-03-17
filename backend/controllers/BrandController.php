<?php

namespace backend\controllers;

use backend\models\Brand;
use PHPUnit\Util\Log\JSON;
use yii\data\Pagination;
use yii\web\UploadedFile;
use crazyfd\qiniu\Qiniu;

class BrandController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //找到所有数据
//        $brands=Brand::find()->all();
          $query=Brand::find();
          $count=$query->count();
          $page=new Pagination([
              'pageSize'=>3,
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
//            $brands->imgFile=UploadedFile::getInstance($brands,'imgFile');
//            $imgPath="";
//          //var_dump($brands->imgFile);exit;
//            if ($brands->imgFile!==null){
//                //定义文件上后保存的路径
//                $imgPath="images/".time().".".$brands->imgFile->extension;
//                // 移动临时文件到$imgPath中去
//                $brands->imgFile->saveAs($imgPath,false);
//                $brands->logo=$imgPath;
//
//            }
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
    //上传图片
    public function actionUpload(){
        $uploadType="local";
       switch (\Yii::$app->params['uploadType']){
           case "local";
           //本地上传
           break;
           case "qiniu";
           //qiniu上传
           break;
       }




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
    public function actionQiniuUpload(){
        $ak = 'g55WlYZmAcfjlQDw4CgilVkj-JiDkt6I7RtcPQM9';
        $sk = '2XVES6fEUq2aK14htnOjSVf-7cOFd-2RHfknBjcy';
        $domain = 'http://p5qemfy7u.bkt.clouddn.com/';
        $bucket = 'php11';
        $zone = 'south_china';
        $qiniu = new Qiniu($ak, $sk,$domain, $bucket,$zone);
        $key = time();
        $key.=$key.strtolower(strrchr($_FILES['file']['name'], '.'));
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
//        var_dump($url);exi
        //定义一个数组
        $ok = [
            'code' => 0,
            'url' => $url,//预览地址
            "attachment" => $url,

        ];
        //返回JSON数组
        return json_encode($ok);

    }
}
