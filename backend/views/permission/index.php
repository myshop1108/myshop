<a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-info">添加</a>
<table class="table">
    <h1>权限列表</h1>
    <tr>
        <th>名称</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
<?php foreach ($pers as $per):?>
        <td><?=strpos($per->name,'/')!==false?"----":""?><?=$per->name?></td>
        <td><?=$per->description?></td>
    <td>
            <a href="<?=\yii\helpers\Url::to(['edit','name'=>$per->name])?>" class="btn btn-success">编辑</a>
            <a href="<?=\yii\helpers\Url::to(['del','name'=>$per->name])?>" class="btn btn-danger">删除</a>


           </td>
    </tr>
<?php endforeach; ?>
</table>

