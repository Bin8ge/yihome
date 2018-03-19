<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/18
 * Time: 13:58
 */

namespace app\controllers;

use app\controllers\common\BaseController;

use app\models\Article;

use yii;

class ArticleController extends BaseController
{
    /**
     * 文章首页
     * @return string
     */
    public function actionIndex()
    {
        $article = Article::find();
        $pagination = new \yii\data\Pagination(['totalCount'=>$article->count(),'pageSize'=> 10]);
        $data = $article->offset($pagination->offset)->limit($pagination->limit)->all();

       return $this->render('index', ['data'=>$data,'pagination'=>$pagination]);
    }

    /**
     * 添加文章
     * @return string
     */
    public function actionAdd()
    {
        $model = new Article();
        if(Yii::$app->request->ispost && $model->load(Yii::$app->request->post()) && $model->save())
        {
            $this->redirect(['index']);
        }
        return $this->render('add',[ 'model' => $model]);
    }

    /**
     * 修改文章
     * @param $id
     * @return string
     */
    public function actionEdit($id)
    {
        $id = (int)$id;
        if($id > 0 && ($model = Article::findOne($id)))
        {
            if(Yii::$app->request->ispost && $model->load(Yii::$app->request->post()) && $model->save())
            {
                $this->redirect(['index']);
            }
            return $this->render('edit',['model'=>$model]);
        }
        return $this->redirect(['index']);
    }

    /**
     * 删除文章
     * @param $id
     * @return yii\web\Response
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $id = (int) $id;
        if( $id > 0 )
        {
            Article::findOne($id)->delete();
        }
        return $this->redirect(['index']);
    }




}