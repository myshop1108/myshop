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
\yii\bootstrap\ActiveForm::end();
//定义js代码块
$js=<<<js
//得到ztree对象
var treeObj=$.fn.zTree.getZTreeObj("w1");
//得到当前节点对象
var node = treeObj.getNodeByParam("id", "$cate->parent_id", null);
//选中当前节点
treeObj.selectNode(node);
//设置parent_id的值
 $("#categorry-parent_id").val($cate->parent_id);
 //调用展开方法
 treeObj.expandAll(true);
js;
//注册JS 把JS代码追加到JQuery之后
$this->registerJs($js);
?>


<!--<a href="--><?//=\yii\helpers\Url::to(['index'])?><!--" class="btn btn-success">返回</a>-->
<script>
    function onClick(e,treeId, treeNode) {
        $("#categorry-parent_id").val(treeNode.id)
        console.dir(treeNode.id)
//        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
//        zTree.expandNode(treeNode);
    }
</script>
