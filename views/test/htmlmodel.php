<?php
    use yii\helpers\Html;
?>
<?=Html::beginForm('','post',['id'=>'addFrom']);?>
<!--生成表单input 的第一种方法-->
<?=Html::activeInput('text',$model,'goods_name',['class'=>'input']);?>
<?=Html::activeInput('hidden',$model,'goods_name',['class'=>'input']);?>
<?=Html::activeInput('password',$model,'goods_name',['class'=>'input']);?>
<!--生成表单的第二种方法-->
<br/>
<br/>
<?=Html::activeTextInput($model,'goods_name',['class'=>'input']);?>
<?=Html::activeHiddenInput($model,'goods_name',['class'=>'input']);?>
<?=Html::activePasswordInput($model,'goods_name',['class'=>'input']);?>

<br/>
<br/>

<?=Html::activeTextArea($model,'goods_cate',['class'=>'area']);?>

<?=Html::activeRadio($model,'is_show',['class'=>'radio']);?>
<br/>
<?=Html::activeRadioList($model,'is_show',[0=>'不显示',1=>'显示'],['class'=>'area']);?>
<br/>
<?=Html::activeDropDownList($model,'is_show',[''=>'请选择',0=>'不显示',1=>'显示'],['class'=>'area']);?>
<br/>
<?=Html::activeCheckbox($model,'is_show',['class'=>'checkbox'])?>
<br/>
<?=Html::activeCheckboxList($model,'is_show',[0=>'不显示',1=>'显示'],['class'=>'checkbox'])?>
<?=Html::submitButton('提交',['class'=>'btn']);?>
<?=Html::endForm();?>



