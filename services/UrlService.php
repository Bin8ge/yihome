<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/13
 * Time: 18:50
 */

namespace app\services;
use yii\helpers\Url;
//统一管理链接 并规范书写
class UrlService
{
    //返回一个内部链接
    public static function buildUrl( $uri,$params = [] )
    {
        return Url::toRoute( array_merge( [ $uri ],$params));

    }
    //返回一个空链接
    public static function buildNullUrl()
    {
        return "javaacript:void(0);";
    }

}