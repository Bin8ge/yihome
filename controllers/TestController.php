<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2016/12/19
 * Time: 15:39
 */

namespace app\controllers;


use app\controllers\common\BaseController;
use yii\web\Controller;

use app\models\Goods;
/*
 * 实例化model
 * */
use app\models\Test;

class TestController extends BaseController
{
    public function actionPage1()
    {
        return $this->render('page1');
    }
    public function actionPage2()
    {
        return $this->render('page2');
    }
    public function actionPage3()
    {
        return $this->render('page3');
    }
    public function actionPage4()
    {
        return $this->render('page4');
    }



    public function actionTest(){
        //echo 1234;
        //$this->goHome();
        /*
         * @渲染视图层 @data 模板变量 可以是数组
         * return  $this->render('test',['data'=> [1,2,3]]);
         *  return $this->renderPartial('test',['data'=>[2,3,4]]);
         * */
       //return  $this->render('test',['data'=> [1,2,3]]);
       // $message = new Book();
        /*
         * 查询方法  一条记录的方法
         * */
        $abc = Goods::findOne(3);
        var_dump($abc);exit;

       // $test = new Test();

        /*
         * 实例化model的两种方法
         * 1.new \app\models\Test();
         * 2.use app\models\Test;
         * */


        //$test = new \app\models\Test();
        //var_dump($test);exit;

        //var_dump($message);
       // return $this->renderPartial('test',['data'=>[2,3,4]]);
       // return  $this->render('test',['data'=> [1,2,3]]);

    }
    /*
     * 驼峰命名用此方式可以访问到
     *r=test/show-user
     * */
    public function actionShowUser(){
        echo 'hello world!';
        $this->goBack();
        /*
         * @重定向
         *
         * $this->redirect(['site/index']);
         * */

        /*
         * @回到首页
         *
         * $this->goHome();
         * */

        /*
         * @回到上个url
         * $this->goBack();
         *
         * */

        /*
         * @重复刷新
         * $this->refresh();
         * */

    }

    /*
     * @request 组件
     *
     * */
    public function actionDo(){

        //var_dump(\yii::$app->request);
        /*
         * 判断是否是ajax post get 传参
         *var_dump(\yii::$app->request->isAjax);
         *var_dump(\yii::$app->request->isPost);
         *var_dump(\yii::$app->request->isGet);
         * */

        /*
         * 获取用户浏览器
         * var_dump(\yii::$app->request->userAgent);
         * */

        /*
         * 获取用户Ip
         * var_dump(\yii::$app->request->userIp);
         * */

        /*
         *get post 传参 $_GET $_POST  一样的效果
         *\yii::$app->request->get()
         *\yii::$app->request->get('r') 获取r的值
         *
         * \yii::$app->request->post()
         *
         * */
        var_dump();
        echo "<br/>";
        var_dump();
    }
    /*
     * @调用html组件之生成model字段关联的html
     *
     * */
    public function actionHtmlmodel(){
        if(\Yii::$app->request->isPost){
           var_dump(\Yii::$app->request->post());
            //exit;
        }

        $html = '<b>hello world!</b>';
        var_dump($html);
        /*
         * 转义json
         * */
        $thtml = \yii\helpers\Html::encode($html);
        var_dump($thtml);
        /*
         * 反转义json
         * */
        $ahtml = \yii\helpers\Html::decode($thtml);
        var_dump($ahtml);
        exit;
       $model =  new \app\models\Goods;
       $model = $model::findOne(1);
       return   $this->render('htmlmodel',['model'=>$model]);
    }


    /*
     *
     * 深入model验证
     * */
    public function  actionVaildate(){
        $data=[
            'Goods'=>[
                'username'   =>  'lizhichao',
                'password'   =>  '123456',
                'repassword' =>  '123456',
                'age'        =>  '34',
                'email'      =>  '123@xinlan.com',
                'number'     =>  '12',
                'pt'         =>  'str23',
                'str'        =>  '巴萨sndakfnkslnafklns',
            ]

        ];

        $test = new \app\models\Goods();
        $test->load($data);
        if ( !$test->validate() ) {
            var_dump($test->getErrors());
        }
    }

    //写入
    public function actionCs()
    {
        $cookie = new \yii\web\Cookie();
        $cookie ->name = 'myName';
        $cookie ->expire = time() + 60*60*24;
        $cookie ->httpOnly = true;
        $cookie ->value = 'LBB';
        var_dump(\Yii::$app->response->getCookies()->add($cookie)); //写入
    }

    //读取
    public function actionSel()
    {
        $cookieSel = \Yii::$app->request->cookies;
        $cookieSel->get('myName');
        print_r($cookieSel['myName']);
    }
    //移除
    public function actionDel()
    {
        $cookie = \Yii::$app->request->cookies->get('myName');
        \Yii::$app->response->getCookies()->remove($cookie);

    }

    public function actions()
    {
        return [
            'captcah'=> [
                'class'     => 'yii\captcha\CaptchaAction',
                'maxLength' => 4,
                'minLength' => 4,
                'width'     => 80,
                'heigth'    => 40,
            ],
        ];
    }
    //验证码
    public function actionCode()
    {
        $model = new \app\models\Test();

        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                echo '验证成功';
            }else
            {
                var_dump($model->getErrors());
            }
        }
        return $this->render('code',['model'=>$model]);
    }








}