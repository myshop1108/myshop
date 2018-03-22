
<table class="table">

    <tr>
        <th>id</th>
        <th>标题</th>
        <th>简介</th>
        <th>排序</th>
        <th>状态</th>
        <th>分类ID</th>
        <th>create_time</th>
        <th>update_time</th>
    </tr>
<?php foreach ($articl as $articl):?>
        <td><?=$articl->id?></td>
        <td><?=$articl->title?></td>
        <td><?=$articl->intro?></td>
        <td><?=$articl->sort?></td>
        <td><?=\backend\models\Articl::$get[$articl->status]?></td>
        <td><?=date('Ymd H:i:s',$articl->create_time)?></td>
        <td><?=date('Ymd H:i:s',$articl->update_time)?></td>
        <td>
            <a href="<?=\yii\helpers\Url::to(['edit','id'=>$articl->id])?>" class="btn btn-success">编辑</a>
            <a href="<?=\yii\helpers\Url::to(['del','id'=>$articl->id])?>" class="btn btn-danger">删除</a>


           </td>
    </tr>
<?php endforeach; ?>
</table>
