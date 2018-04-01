<?php

use leandrogehlen\treegrid\TreeGrid;?>
<h1>商品分类列表</h1>
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
