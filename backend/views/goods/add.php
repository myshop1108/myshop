<?php
//var_dump($articlArr);exit;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($good,'name');
echo $form->field($good,'sn');
echo $form->field($good,'goods_category_id')->dropDownList($categorryArr);
echo $form->field($good,'market_price');
echo $form->field($good,'shop_price');
echo $form->field($good,'brand_id')->dropDownList($articlArr);
echo $form->field($good,'stock');
echo $form->field($good,'sort');
echo $form->field($good,'status')->inline()->radioList([1=>'上线',2=>'下线',3=>'未知'],['value'=>3]);
echo $form->field($good, 'logo')->widget(\manks\FileInput::className(),[]);




echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-info']);

\yii\bootstrap\ActiveForm::end();