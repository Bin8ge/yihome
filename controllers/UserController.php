<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/13
 * Time: 20:32
 */

namespace app\controllers;


use app\controllers\common\BaseController;
use app\models\User;
use app\models\UserRole;
use app\models\Role;
use app\services\UrlService;

class UserController extends BaseController
{
    /**
     * 用户登录页面
     * @return string
     */
    public function actionLogin()
    {
        return $this->render("login",[
            'host' => $_SERVER['HTTP_HOST']]);
    }
    /**
     * 伪登录业务方法，所以伪登录功能也是需要有auth_token
     */
    public function actionVlogin()
    {
        $uid = $this->get('uid',0);
        $reback_url = UrlService::buildUrl("/");
        if( !$uid )
        {
            return $this->redirect( $reback_url );
        }
        $user_info = User::find()->where(['id' => $uid] )->one();
        if(!$user_info)
        {
            return $this->redirect( $reback_url );
        }
        //cookie 保存用户的登录状态，所以cookie值需要加密，规则： user_auth_token + '#' + uid
        $this->createLoginStatus( $user_info );
        return $this->redirect( $reback_url );
    }

    /**
     * 用户列表页面
     * @return string
     */
    public function actionIndex()
    {
        $info = User::find()->where( [ 'status'=>1 ] )->orderBy(['id'=> SORT_DESC])->all();
        return $this->render('index',['list'=>$info]);
    }

    public function actionSet()
    {
        $dateNow =  date('Y-m-d H:i:s');

        if(\Yii::$app->request->isGet)
        {
            $id = $this->get('id',0);
            $info = [];
            if ( $id )
            {
                $info =  User::find()->where( [ 'id'=>$id ,'status'=>1] )->one();
            }

            //取出所有角色
            $role_list = Role::find()->orderBy( [ 'id'=> SORT_DESC ] )->all();

            //取出所有已分配角色
            $user_role_list = UserRole::find()->where( [ 'uid'=>$id ] )->asArray()->all();
            $related_role_ids = [];
            foreach($user_role_list as $k=> $val){
                $related_role_ids[] = $val['role_id'];
            }
            return $this->render('set',[
                'info'=>$info ,
                'role_list'=>$role_list,
                'related_role_ids'=>$related_role_ids
            ]);
        }

        $name      = $this->post("name",'');
        $id        = $this->post('id',0);
        $email     = $this->post('email','');
        $role_ids  = $this->post('role_ids',[]);

        if ( mb_strlen($name,'utf-8') < 1 || mb_strlen($name,'utf-8') > 20)
        {
            return $this->renderJSON([],'请输入合法姓名~~',-1);
        }
        if ( !filter_var($email,FILTER_SANITIZE_EMAIL) )
        {
            return $this->renderJSON([],'请输入合法的邮箱~~',-1);
        }
        //查询角色是否存在角色相等的记录
        $has_in = User::find()->where( [ 'email'=>$email ] )->andWhere( [ '!=','id',$id ] )->one();
        if( $has_in )
        {
            return $this->renderJSON([],'该邮箱已存在~~',-1);
        }

        $info = User::find()->where(['id'=>$id])->one();
        if ( $info )
        {//编辑
            $user_mdoel = $info;
        }else{//添加
            $user_mdoel  = new User();
            $user_mdoel->created_time = $dateNow;
            $user_mdoel->status = 1;
        }
        $user_mdoel->name  = $name;
        $user_mdoel->email = $email;
        $user_mdoel->updated_time = $dateNow;
        if ( $user_mdoel->save(0) )
        {
            /**
             * 找出删除的角色
             * 假如已有的角色集合是A,界面传递过来的角色是B
             * 角色集合A当中的莫个角色不在角色B集合中，就应该删除
             */
            $user_role_list = UserRole::find()->where( [ 'uid'=>$user_mdoel->id ] )->all();
            $related_role_ids = [];
            if ( $user_role_list )
            {
                foreach( $user_role_list as $_item){
                    $related_role_ids[] = $_item;
                    if( !in_array($_item['id'],$role_ids))
                    {
                        $_item->delete();
                    }
                }
            }
            /**
             * 找出删除的角色
             * 假如已有的角色集合是A,界面传递过来的角色是B
             * 角色集合A当中的莫个角色不在角色B集合中，就应该删除
             */
            if ( $role_ids )
            {
                foreach ( $role_ids as $role_id ){
                    if ( !in_array($role_id,$related_role_ids) )
                    {
                        $model_user_role = new UserRole();
                        $model_user_role->uid          = $user_mdoel->id;
                        $model_user_role->role_id      = $role_id;
                        $model_user_role->created_time = $dateNow;
                        $model_user_role->save(0);
                    }
                }
            }
        }
        return $this->renderJSON([],'操作成功~~',200);
    }

}