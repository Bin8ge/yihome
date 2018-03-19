<?php
use \app\services\UrlService;

?>
<div class="row">
    <div class="col-xs-9 col-sm-9 col-lg-9">
        <h5>权限列表</h5>
    </div>
    <div class="col-xs-3 col-sm-3 col-lg-3">
        <a href="<?= UrlService::buildUrl('/access/set') ?>">添加权限</a>
    </div>
</div>
<hr/>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <th>权限</th>
        <th>Urls</th>
        <th>操作</th>
        </thead>
        <tbody>
        <?php if ( $list ) :?>
            <?php foreach($list as $v):?>
                <?php
                $tmp_urls = @json_decode( $v['urls'],true );
                $tmp_urls = $tmp_urls?$tmp_urls:[];
                ?>
                <tr>
                    <td><?=$v['title']?></td>
                    <td><?=implode("<br/>",$tmp_urls);?></td>
                    <td>
                        <a href="<?=UrlService::buildUrl('/access/set',['id'=>$v['id']])?>">编辑</a>
                    </td>
                </tr>
            <?php endforeach?>

        <?php else:?>
            <tr>
                <td colspan="3">暂无权限</td>
            </tr>
        <?php endif?>


        </tbody>
    </table>
</div>
