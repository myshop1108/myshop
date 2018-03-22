<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password')->passwordInput();
echo $form->field($model,'status')->inline()->radioList(['禁止','激活'],['value'=>1]);
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-info']);

\yii\bootstrap\ActiveForm::end();