<?php
use \app\services\UrlService;

?>
<div class="row">
    <div class="col-xs-9 col-sm-9 col-lg-9">
        <h5>角色列表</h5>
    </div>
    <div class="col-xs-3 col-sm-3 col-lg-3">
        <a href="<?= UrlService::buildUrl('/role/set') ?>">添加角色</a>
    </div>
</div>
<hr/>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <th>角色</th>
        <th>操作</th>
        </thead>
        <tbody>
        <?php if ( $list ) :?>
            <?php foreach($list as $v):?>
                <tr>
                    <td><?=$v['name']?></td>
                    <td>
                        <a href="<?=UrlService::buildUrl('/role/set',['id'=>$v['id']])?>">编辑</a>  | <a href="<?=UrlService::buildUrl('/role/access',['id'=>$v['id']])?>">设置权限</a>
                    </td>
                </tr>
            <?php endforeach?>

        <?php else:?>
            <tr>
                <td colspan="2">暂无数据</td>
            </tr>
        <?php endif?>


        </tbody>
    </table>
</div>
