<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/20
 * Time: 19:10
 */
use \yii\helpers\Html;
?>

<?=Html::beginForm('','post',['class'=> 'form']);?>
<?=\yii\captcha\Captcha::widget([
    'model'=>$model,
    'attribute'      => 'code',
    'captchaAction'  => 'test/captcha',
    'template'       =>'{input}----{image}',
    'options'        => [
        'class' => 'input veriyfcode',
        'id' => 'verifyCode'
    ],
    'imageOptions'   => [
        'alt' => '点击换验证码',
    ],
]);?>
<?=Html::submitButton('提交',['class'=>'btn btn-primary'])?>
<?=Html::endForm();?>
