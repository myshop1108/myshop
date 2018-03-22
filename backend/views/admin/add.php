<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password');
echo $form->field($model,'email');
echo $form->field($model,'status')->inline()->radioList([1=>'禁止',2=>'激活',3=>'未知'],['value'=>3]);
echo $form->field($model,'token');
echo $form->field($model,'last_login_ip');
echo \yii\bootstrap\Html::submitButton("注册",['class'=>'btn btn-info']);

\yii\bootstrap\ActiveForm::end();