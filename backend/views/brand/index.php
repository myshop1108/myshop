<a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-info">添加</a>
<table class="table">

    <tr>
        <th>id</th>
        <th>名称</th>
        <th>排序</th>
        <th>状态</th>
        <th>简介</th>
        <th>图像</th>
    </tr>
<?php foreach ($brands as $brand):?>
        <td><?=$brand->id?></td>
        <td><?=$brand->name?></td>
        <td><?=$brand->sort?></td>
        <td><?=$brand->status?></td>
        <td><?=$brand->intro?></td>
    <td><?=\yii\bootstrap\Html::img("/".$brand->logo,['height'=>50])?>




        <td>
            <a href="<?=\yii\helpers\Url::to(['edit','id'=>$brand->id])?>" class="btn btn-success">编辑</a>
            <a href="<?=\yii\helpers\Url::to(['del','id'=>$brand->id])?>" class="btn btn-danger">删除</a>


           </td>
    </tr>
<?php endforeach; ?>
</table>
<?=\yii\widgets\LinkPager::widget([
    'pagination' => $page,

])?>

