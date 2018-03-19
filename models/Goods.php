<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2016/12/19
 * Time: 17:18
 */

namespace app\models;


use yii\db\ActiveRecord;

class Goods extends ActiveRecord
{
    public $username;
    public $password;
    public $repassword;
    public $age;
    public $email;
    public $number;
    public $pt;
    public $str;

    public static function tableName(){
        return '{{%goods}}';
    }

    public function rules(){
        return [
           /* ['username','required','message'=>'用户名不可为空！'],
            ['password','required','message'=>'密码不可为空！'],*/
            [['password','username'],'required','message'=>'不可为空！'],
            // compare 设置值作对比
            ['password','compare','compareValue'=>'123456','message'=>'密码不是123！'],
            //safe 不要验证
            ['repassword','safe'],
            // compare 对比验证
            ['password','compare','compareAttribute'=>'repassword','message'=>'两次密码不一致！'],
            // double 双精度验证
            ['age','double','min'=>1,'max'=>200,'tooSmall'=>'值太小了','tooBig'=>'超过最大值200了','message'=>'非法字符'],
            // integer 整数
            ['number','integer','min'=>1,'max'=>200,'tooSmall'=>'值太小了','tooBig'=>'超过最大值200了','message'=>'不是整数'],
            //in 范围验证
            ['number','in','range'=>[1,12],'message'=>'不在此范围内'],
            //邮箱验证
            ['email','email','message'=>'非法邮箱!'],
            //正则验证
            ['pt','match','pattern'=>'/^str\d{2}$/','message'=>'非法操作！'],
            //字符串验证
            ['str','string','min'=>'10','max'=>'20','tooShort'=>'字符串太短','tooLong'=>'字符串太长'],
            //自定义函数
            ['username','checkUsername','params'=>['message'=>'搞笑军一枚']],
        ];
    }

    //验证username 的方法
    public function checkUsername($attribute,$params){
        //var_dump($this->$attribute);
        if($this->$attribute != '逗逼'){
            $this->addError($attribute,$params);
        }
    }

}