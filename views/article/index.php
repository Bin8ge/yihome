<?php
use \app\services\UrlService;

?>
<p style="text-align: right;">
    <a href="<?= UrlService::buildUrl("/article/add"); ?>" class="btn btn-primary">添加</a>
</p>
<table class="table table-hover">
    <tr>
        <th>id</th>
        <th>标题</th>
        <th>浏览次数</th>
        <th>状态</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    <?php foreach($data as $v){?>
    <tr>
        <td><?=$v['id']?></td>
        <td><?=$v['title']?></td>
        <td><?=$v['count']?></td>
        <td><?=$v['status']==1?'是':'否'?></td>
        <td><?=date('Y-m-d H:i:s',$v['date'])?></td>
        <td><a href="<?= UrlService::buildUrl('/article/edit',['id'=>$v['id']]); ?>">编辑</a> | <a href="<?= UrlService::buildUrl('/article/delete',['id'=>$v['id']]); ?>">删除</a></td>
    </tr>
    <?php }?>
</table>
<div style="float: right">
    <?=\yii\widgets\LinkPager::widget([
       'pagination' => $pagination,
        'options'   => [
          'class' => 'pagination',
        ],
    ]);?>
</div>
<div style="clear: both">

</div>