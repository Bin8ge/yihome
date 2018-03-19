<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2016/12/19
 * Time: 17:39
 */

namespace app\models;
use app\services\UrlService;
use yii\base\Model;


class Test extends Model
{
    public $code;
    public function rules()
    {
        return [
            ['code', 'captcha' ,'captchaAction'=>[UrlService::buildUrl('./test/captcha')], 'message'=>'验证码不正确']
        ];
    }
}