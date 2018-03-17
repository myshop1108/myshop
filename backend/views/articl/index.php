<a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-info">添加</a>
<table class="table">

    <tr>
        <th>id</th>
        <th>标题</th>
        <th>分类</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>分类时间</th>
        <th>操作</th>
    </tr>
<?php foreach ($articl as $articl):?>
        <td><?=$articl->id?></td>
        <td><?=$articl->title?></td>
        <td><?=$articl->cate->name?></td>
        <td><?=$articl->intro?></td>
        <td><?=\backend\models\Category::$post[$articl->status]?></td>
        <td><?=$articl->sort?></td>
        <td><?=date('Ymd H:i:s',$articl->create_time)?></td>
        <td>
            <a href="<?=\yii\helpers\Url::to(['edit','id'=>$articl->id])?>" class="btn btn-success">编辑</a>
            <a href="<?=\yii\helpers\Url::to(['del','id'=>$articl->id])?>" class="btn btn-danger">删除</a>


           </td>
    </tr>
<?php endforeach; ?>
</table>
<?=\yii\widgets\LinkPager::widget([
    'pagination' => $page,

])?>

