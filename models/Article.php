<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrs_article".
 *
 * @property string $id
 * @property integer $flag
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $count
 * @property string $status
 * @property string $update_date
 * @property string $date
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'required', 'message' => '标题不能为空'],
            ['title', 'string','min'=>2, 'max' => 200,'tooShort'=>'标题不能少于2位'],
            ['content', 'required', 'message' => '内容不能为空'],
            ['description', 'string','max'=>500, 'message' => '描述不能大于500位'],
            ['flag', 'integer','min'=>0,'max'=>9, 'tooSmall' => '非法操作','tooBig'=>'非法操作','message'=>'非法操作'],
            ['count', 'integer','min'=>0,'tooSmall' => '必须大于等于0的整数','message'=>'请输入一个整数'],
            ['status', 'in','range'=>['1','2'],'message'=>'非法操作'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flag' => 'Flag',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'count' => 'Count',
            'status' => 'Status',
            'update_date' => 'Update Date',
            'date' => 'Date',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $time = time();
            if($this->isNewRecord)
            {
                $this->date = $time;
            }
            $this->update_date = $time;
            return true;
        }
        return false;
    }
}
