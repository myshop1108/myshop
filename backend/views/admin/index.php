
<table class="table">
    <h1>管理员表</h1>
    <tr>
        <th>id</th>
        <th>名字</th>
        <th>密码</th>
        <th>状态</th>
        <th>IP地址</th>
        <th>注册时间</th>
        <th>最后登录时间</th>
        <th>操作</th>
    </tr>
<?php foreach ($admin as $admins):?>
        <td><?=$admins->id?></td>
        <td><?=$admins->username?></td>
        <td><?=$admins->password?></td>
        <td><?=$admins->status?></td>
        <td><?=$admins->login_ip?></td>
        <td><?=date('Ymd H:i:s',$admins->created_at)?></td>
        <td><?=date('Ymd H:i:s',$admins->updated_at)?></td>
        <td>
            <a href="<?=\yii\helpers\Url::to(['edit','id'=>$admins->id])?>" class="btn btn-success">编辑</a>
            <a href="<?=\yii\helpers\Url::to(['del','id'=>$admins->id])?>" class="btn btn-danger">删除</a>


           </td>
    </tr>
<?php endforeach; ?>
</table>
