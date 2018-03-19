<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/21
 * Time: 11:08
 */
// \Yii::$app->getView()->registerJs("/js/role/set.js",\app\assets\AppAsset::className());
use \app\services\StaticService;
use \app\services\UrlService;
StaticService::includeAppJsStatic("js/access/set.js",\app\assets\AppAsset::className());
?>
<div class="row">
    <div class="col-xs-9 col-sm-9 col-lg-9">
        <h5>新增权限</h5>
    </div>

</div>
<hr/>
<div class="row">
    <div class="form-horizontal access_set_wrap" role="form">
        <div class="form-group">
            <label class="col-xs-2 col-lg-2 col-sm-2 col-md-2 control-label">权限标题</label>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                <input type="text" class="form-control" name="title" placeholder="请输入权限" value="<?=$info?$info['title']:'';?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 col-lg-2 col-sm-2 col-md-2 control-label">Urls</label>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                <?php
                $urls = $info?@json_decode( $info['urls'],true ):[];
                $urls = $urls?$urls:[];
                ?>
                <textarea name="urls" rows="5" class="form-control" placeholder="一行一个url"><?=implode("\r\n",$urls);?></textarea>
            </div>
        </div>


        <div class="col-xs-6 col-sm-offset-2 col-lg-offset-2 col-md-offset-2 col-xs-offset-2 col-sm-6 col-md-6 col-lg-6 ">
            <input type="hidden" name="id" value="<?=$info?$info['id']:'';?>">
            <button type="button" class="btn btn-primary pull-right save">确定</button>
        </div>
    </div>

</div>
