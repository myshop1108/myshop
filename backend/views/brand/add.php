<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($brands,'name');
echo $form->field($brands,'sort');
echo $form->field($brands,'status')->inline()->radioList([1=>'上线',2=>'下线',3=>'未知'],['value'=>3]);
echo $form->field($brands,'intro')->textarea();
echo $form->field($brands, 'logo')->widget(\manks\FileInput::className(),[]);



echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-info']);

\yii\bootstrap\ActiveForm::end();