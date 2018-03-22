<?php
//var_dump($articlArr);exit;
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($good,'name');
echo $form->field($good,'sn');
echo $form->field($good,'goods_category_id')->dropDownList($categorryArr,['prompt'=>'请选择分类']);
echo $form->field($intro,'content')->widget(kucha\ueditor\UEditor::className(),[]);
echo $form->field($good,'market_price');
echo $form->field($good,'shop_price');
echo $form->field($good,'brand_id')->dropDownList($articlArr,['prompt'=>'请选择品牌']);
echo $form->field($good,'stock');
echo $form->field($good,'sort');
echo $form->field($good,'status')->inline()->radioList([1=>'禁用',2=>'激活'],['value'=>'禁用']);
echo $form->field($good, 'logo')->widget(\manks\FileInput::className(),[]);
echo $form->field($good, 'images')->widget(\manks\FileInput::className(),[
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
        // 'server' => Url::to('upload/u2'),
        // 'accept' => [
        // 	'extensions' => 'png',
        // ],
    ],]);




echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-info']);

\yii\bootstrap\ActiveForm::end();