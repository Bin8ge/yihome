<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/21
 * Time: 10:33
 */

namespace app\controllers;


use app\controllers\common\BaseController;

class DefaultController extends BaseController
{
    //默认首页
    public function actionIndex()
    {
        return $this->render("index");
    }

}