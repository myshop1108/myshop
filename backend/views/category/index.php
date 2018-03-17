<a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-info">添加</a>
<table class="table">

    <tr>
        <th>id</th>
        <th>名称</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>是不是帮助类</th>
    </tr>
<?php foreach ($cate as $cate):?>
        <td><?=$cate->id?></td>
        <td><?=$cate->name?></td>
        <td><?=$cate->intro?></td>
        <td><?=\backend\models\Category::$post[$cate->is_help]?></td>
        <td><?=$cate->sort?></td>
        <td><?=\backend\models\Category::$get[$cate->is_help]?></td>




        <td>
            <a href="<?=\yii\helpers\Url::to(['edit','id'=>$cate->id])?>" class="btn btn-success">编辑</a>
            <a href="<?=\yii\helpers\Url::to(['del','id'=>$cate->id])?>" class="btn btn-danger">删除</a>


           </td>
    </tr>
<?php endforeach; ?>
</table>
<?=\yii\widgets\LinkPager::widget([
    'pagination' => $page,

])?>

