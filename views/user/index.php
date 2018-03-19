<?php
use \app\services\UrlService;

?>
<div class="row">
    <div class="col-xs-9 col-sm-9 col-lg-9">
        <h5>用户列表</h5>
    </div>
    <div class="col-xs-3 col-sm-3 col-lg-3">
        <a href="<?= UrlService::buildUrl('/user/set') ?>">添加用户</a>
    </div>
</div>
<hr/>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <th>姓名</th>
        <th>邮箱</th>
        <th>操作</th>
        </thead>
        <tbody>
        <?php if ( $list ) :?>
            <?php foreach($list as $v):?>
                <tr>
                    <td><?=$v['name']?></td>
                    <td><?=$v['email']?></td>
                    <td>
                        <a href="<?=UrlService::buildUrl('/user/set',['id'=>$v['id']])?>">编辑</a>
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
