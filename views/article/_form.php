<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/20
 * Time: 16:00
 */
use yii\helpers\html;
use \app\services\UrlService;
?>
<style>
    .error {color: red}
</style>
<div>
    <?= html::beginForm('', 'post', ['class' => 'form-horizontal']) ?>
<div class="form-group">
    <?= Html::label('标题', 'title', ['class' => 'col-sm-2 control-label']); ?>
    <div class="col-sm-10">
        <?= Html::activeInput('text', $model, 'title', ['class' => 'form-control']); ?>
        <?= Html::error($model, 'title', ['class' => 'error']); ?>
    </div>
</div>
<div class="form-group">
    <?= Html::label('描述', 'description', ['class' => 'col-sm-2 control-label']); ?>
    <div class="col-sm-10">
        <?= Html::activeTextArea($model, 'description', ['class' => 'form-control']); ?>
        <?= Html::error($model, 'description', ['class' => 'error']); ?>
    </div>
</div>
<div class="form-group">
    <?= Html::label('内容', 'content', ['class' => 'col-sm-2 control-label']); ?>
    <div class="col-sm-10">
        <?= Html::activeTextArea($model, 'content', ['class' => 'form-control']); ?>
        <?= Html::error($model, 'content', ['class' => 'error']); ?>
    </div>
</div>
<div class="form-group">
    <?= Html::label('标示', 'flag', ['class' => 'col-sm-2 control-label']); ?>
    <div class="col-sm-10">
        <?= Html::activeRadioList($model, 'flag', ['0' => '普通', '1' => '热门', '2' => '置顶']); ?>
        <?= Html::error($model, 'flag', ['class' => 'error']); ?>
    </div>
</div>
<div class="form-group">
    <?= Html::label('浏览次数', 'count', ['class' => 'col-sm-2 control-label']); ?>
    <div class="col-sm-10">
        <?= Html::activeInput('text', $model, 'count', ['class' => 'form-control']); ?>
        <?= Html::error($model, 'count', ['class' => 'error']); ?>
    </div>
</div>
<div class="form-group">
    <?= Html::label('状态', 'status', ['class' => 'col-sm-2 control-label']); ?>
    <div class="col-sm-10">
        <?= Html::activeDropDownList($model, 'status', ['1' => '是', '2' => '否'], ['class' => 'form-control']); ?>
        <?= Html::error($model, 'status', ['class' => 'error']); ?>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('提交', ['class' => 'btn btn-primary col-sm-offset-2']); ?>
    <a href="<?=UrlService::buildUrl('/article/index')?>" class="btn btn-default">返回</a>
</div>
<?= html::endForm(); ?>

</div>