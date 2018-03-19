<?php
    /*
     *@html 组件
     * */
    use yii\helpers\Html;
?>
<!--1.生成表单输入框-->
<?=Html::beginForm('','post',['id'=>'addFrom','class'=>'from','data'=>'fm']);?>
<?=Html::input('text','name','smister',['class'=> 'input']);?>
<?=Html::input('hidden','hidden','',['id'=>'hidden','class'=>'input hidden']);?>
<?=Html::input('password','pass','',['id'=>'pass','class'=>'input pass']);?>
<br/>
<br/>
<!--2.生成表单输入框-->
<?=Html::textInput('name','smister',['class' => 'input']);?>
<?=Html::passwordInput('pass','',['class' => 'input pass']);?>
<?=Html::hiddenInput('hidden','',['class' => 'input hidden']);?>
<br/>
<br/>

<!--生成表单文本域-->
<?=Html::textarea('area','textarea',['class'=> 'input area']);?>
<br/>
<!--生成radio-->
男<?=Html::radio('status',false,['class'=>'radio']);?>
女<?=Html::radio('status',true,['class'=>'radio']);?>
<br/>
<!--s生成radio列表-->
<?=Html::radioList('sex',1,[0=>'女',1=>'男'],['class'=>'radio']);?>
<br/>
<!--生成checkbox-->
复选框：<?=Html::checkbox('checkbox',true,['class'=>'checkbox']);?>
<!--生成checkbox列表-->
复选框列表：<?=Html::checkboxList('checkboxList','',[1=>'数学',2=>'语文'],['class'=>'chexList']);?>
<!--生成selecet下拉框-->
<?=Html::dropDownList('sts','0',[0=>'请选择',1=>'php',2=>'java',3=>'pytan',4=>'R语言'],['class'=>'select'])?>

<br/>
<!--生成label-->
<?=Html::label('这里所显示的：','username',['class'=>'lable','style'=>'color:red;']);?>
<br/>
<!--生成file-->
<?=Html::fileInput('image',null,['class'=>'uploda']);?>
<br/>
<!--生成按钮-->
<?=Html::button('普通按钮',['class'=>'button']);?>
<br/>
<?=Html::submitButton('提交',['class'=>'submit']);?>
<br/>
<?=Html::resetButton('重置',['class'=>'reset']);?>
<?=Html::endForm()?>
