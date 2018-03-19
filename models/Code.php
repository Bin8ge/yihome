<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/20
 * Time: 19:03
 */

namespace app\models;
use app\services\UrlService;
use yii\base\Model;

class Code extends Model
{
     public $code;
     public function rules()
     {
         return [
             'allow',
             ['code', 'captcha' ,'captchaAction'=>[UrlService::buildUrl('./test/captcha')], 'message'=>'验证码不正确']
         ];
     }

}