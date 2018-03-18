<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($cate,'name');
echo $form->field($cate,'parent_id')->textarea(['value'=>0]);
echo \liyuze\ztree\ZTree::widget([
    'setting' => '{
			data: {
				simpleData: {
					enable: true,
					pIdKey:"parent_id",
				}
			},
			callback: {
				onClick: onClick
			}
		}',
    'nodes' => $catesJson
]);
echo $form->field($cate,'intro')->textarea();




echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();?>
<a href="<?=\yii\helpers\Url::to(['index'])?>" class="btn btn-success">返回</a>
<script>
    function onClick(e,treeId, treeNode) {
        $("#categorry-parent_id").val(treeNode.id)
        console.dir(treeNode.id)
//        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
//        zTree.expandNode(treeNode);
    }
</script>
