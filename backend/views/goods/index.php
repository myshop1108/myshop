<?php

use leandrogehlen\treegrid\TreeGrid;?>
<h1>商品表</h1>
<form class="form-inline pull-right">
    <select class="form-control" name="status">
        <option>请选择状态</option>
        <option value="1" <?=Yii::$app->request->get('status')==="1"?"selected":""?>>禁用</option>
        <option value="2" <?=Yii::$app->request->get('status')==="2"?"selected":""?>>激活</option>
    </select>
    <div class="form-group">
        <input type="text" class="form-control" id="minPrice" placeholder="最低价" name="minPrice" size="5" value="<?=Yii::$app->request->get('minPrice')?>">
    </div>
    —
    <div class="form-group">
        <input type="text" class="form-control" id="maxPrice" placeholder="最高价" name="maxPrice" size="5" value="<?=Yii::$app->request->get('maxPrice')?>">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="keyword" placeholder="名称或货号" name="keyword" size="8" value="<?=Yii::$app->request->get('keyword')?>">
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
</form>
<table class="table">

    <tr>
        <th>id</th>
        <th>名称</th>
        <th>货号</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>图像</th>
        <th>操作</th>
    </tr>
<?php foreach ($good as $good):?>
        <td><?=$good->id?></td>
        <td><?=$good->name?></td>
        <td><?=$good->sn?></td>
        <td><?=$good->goods_category_id?></td>
        <td><?=$good->brand_id?></td>
        <td><?=$good->market_price?></td>
        <td><?=$good->shop_price?></td>
        <td><?=$good->stock?></td>
        <td><?=\backend\models\Goods::$get[$good->status]?></td>
        <td><?=$good->sort?></td>
        <td><?=date('Ymd H:i:s',$good->inputtime)?></td>
    <td><?php
        $imgPath=strpos($good->logo,"ttp://")?$good->logo:"/".$good->logo;
        echo \yii\bootstrap\Html::img($good->logo,['height'=>50]);
        ?></td>
        <td>
            <a href="<?=\yii\helpers\Url::to(['edit','id'=>$good->id])?>" class="btn btn-success">编辑</a>
            <a href="<?=\yii\helpers\Url::to(['del','id'=>$good->id])?>" class="btn btn-danger">删除</a>


           </td>
    </tr>
<?php endforeach; ?>
</table>
<?=\yii\widgets\LinkPager::widget([
    'pagination' => $page,

])?>

