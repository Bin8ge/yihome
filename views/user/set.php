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
StaticService::includeAppJsStatic("js/user/set.js",\app\assets\AppAsset::className());
?>
<div class="row">
    <div class="col-xs-9 col-sm-9 col-lg-9">
        <h5>新增用户</h5>
    </div>

</div>
<hr/>
<div class="row">
    <div class="form-horizontal user_set_wrap" role="form">
        <div class="form-group">
            <label class="col-xs-2 col-lg-2 col-sm-2 col-md-2 control-label">用户</label>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                <input type="text" class="form-control" name="name" placeholder="请输入姓名" value="<?=$info?$info['name']:'';?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 col-lg-2 col-sm-2 col-md-2 control-label">邮箱</label>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                <input type="text" class="form-control" name="email" placeholder="请输入邮箱" value="<?=$info?$info['email']:'';?>">
            </div>
        </div>

        <!--所属角色-->
        <div class="form-group">
            <label class="col-xs-2 col-lg-2 col-sm-2 col-md-2 control-label">所属角色</label>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 ">
                <?php if($role_list):?>
                    <?php foreach($role_list as $val):?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="role_ids[]" value="<?=$val['id']?>"
                                <?php if(in_array($val['id'],$related_role_ids)):?>checked <?php endif?>

                                />
                                <?=$val['name']?>
                            </label>
                        </div>
                    <?php endforeach?>
                <?php endif?>
            </div>
        </div>
        <div class="col-xs-6 col-sm-offset-2 col-lg-offset-2 col-md-offset-2 col-xs-offset-2 col-sm-6 col-md-6 col-lg-6 ">
            <input type="hidden" name="id" value="<?=$info?$info['id']:'';?>">
            <button type="button" class="btn btn-primary pull-right save">确定</button>
        </div>
    </div>

</div>
