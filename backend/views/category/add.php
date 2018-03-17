<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($cate,'name');
echo $form->field($cate,'sort');
echo $form->field($cate,'status')->inline()->radioList([1=>'上线',2=>'下线',3=>'未知'],['value'=>3]);
echo $form->field($cate,'intro')->textarea();
echo $form->field($cate,'is_help')->inline()->radioList([1=>'是',2=>'否',3=>'未知'],['value'=>3]);




echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-info']);

\yii\bootstrap\ActiveForm::end();