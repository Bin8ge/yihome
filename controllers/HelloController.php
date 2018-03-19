<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/14
 * Time: 18:52
 */

namespace app\controllers;


use app\controllers\common\BaseController;

class HelloController extends BaseController
{
    public function actionIndex()
    {
        $res = \Yii::$app->response;
        $res->headers->add('pragma','no-cache');
        $res->headers->set('pragma','max-age=5');
        $res->headers->remove('pragma');

        //跳转
        $res->headers->add('location','http://www.baidu.com');
        $this->redirect('www.qq.com');

        //文件下载
        $res->headers->add('content-disposition','attachment;filename="a.jpg"');

    }

}