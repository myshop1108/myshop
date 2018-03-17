<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($articl,'title');
echo $form->field($articl,'intro');
echo $form->field($articl,'sort');
echo $form->field($articl,'cate_id')->dropDownList($articlArr);
echo $form->field($content,'detail')->widget('kucha\ueditor\UEditor',[]);
echo $form->field($articl,'status')->inline()->radioList([1=>'禁止',2=>'激活',3=>'未知'],['value'=>3]);


echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-info']);

\yii\bootstrap\ActiveForm::end();