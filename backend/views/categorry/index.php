<?php

use leandrogehlen\treegrid\TreeGrid;?>
<a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-info">添加</a>
<table class="table">
<tr></tr>
<td>
<?= TreeGrid::widget([
    'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'parentRootValue' => '0', //first parentId value
    'pluginOptions' => [
        'initialState' => 'collapsed',
    ],
    'columns' => [
        'name',
        'id',
        'intro',
        'parent_id',
        ['class' => 'yii\grid\ActionColumn']
    ]
]);
?>
</td>
    </tr>
</table>
