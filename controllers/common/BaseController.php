<?php
/**
 * Created by PhpStorm.
 * User: afellow
 * Date: 2017/12/13
 * Time: 20:22
 */

namespace app\controllers\common;


use app\services\UrlService;
use yii\web\Controller;
use app\models\User;
use app\models\UserRole;
use app\models\RoleAccess;
use app\models\Access;


//以后所有控制器的基类，并且集成常用公用方法
class BaseController extends Controller
{
    protected $auth_cookie_name = 'bingege';
    protected $current_user = null;//当前登录人信息
    protected $allowAllAction = [
        'user/login',
        'user/vlogin'
    ];

    public $ignore_url = [
        'error/forbidden' ,
        'user/vlogin',
        'user/login'
    ];

    public $privilege_urls = [];//保存去的权限链接

    /**
     * 本系统所有页面都是需要登录之后才能访问，  在框架中加入统一的验证方法
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction( $action )
    {
        $login_status = $this->checkLoginStatus();
        if (!$login_status && !in_array($action->uniqueId, $this->allowAllAction)) {
            if (\Yii::$app->request->isAjax) {
                $this->renderJSON([], "未登录，请返回用户中心", -302);
            } else {
                $this->redirect(UrlService::buildUrl("/user/login"));//返回登录页面
            }
            return false;
        }
        /**
         * 判断权限的逻辑是
         * 取出当前登录用户的所属角色，
         * 在通过角色 取出 所属 权限关系
         * 在权限表中取出所有的权限链接
         * 判断当前访问的链接 是否在 所拥有的权限列表中
         */
        //判断当前访问的链接 是否在 所拥有的权限列表中
        if( !$this->checkPrivilege( $action->getUniqueId() ) )
        {
            $this->redirect( UrlService::buildUrl( "/error/forbidden" ) );
            return false;
        }
        return true;
    }

    /**
     * 检查是否有访问指定链接的权限
     * @param $url
     * @return bool
     */
    public function checkPrivilege( $url ){
        //如果是超级管理员 也不需要权限判断
        if( $this->current_user && $this->current_user['is_admin'] ){
            return true;
        }

        //有一些页面是不需要进行权限判断的
        if( in_array( $url,$this->ignore_url ) ){
            return true;
        }
        return in_array( $url, $this->getRolePrivilege() );
    }


    /**
     * 获取某用户的所有权限
     * 取出指定用户的所属角色，
     * 在通过角色 取出 所属 权限关系
     * 在权限表中取出所有的权限链接
     */
    public function getRolePrivilege($uid = 0)
    {
        if (!$uid && $this->current_user) {
            $uid = $this->current_user->id;
        }

        if (!$this->privilege_urls) {
            $role_ids = UserRole::find()->where(['uid' => $uid])->select('role_id')->asArray()->column();
            if ($role_ids) {
                //在通过角色 取出 所属 权限关系
                $access_ids = RoleAccess::find()->where(['role_id' => $role_ids])->select('access_id')->asArray()->column();
                //在权限表中取出所有的权限链接
                $list = Access::find()->where(['id' => $access_ids])->all();
                if ($list) {
                    foreach ($list as $_item) {
                        $tmp_urls = @json_decode($_item['urls'], true);
                        $this->privilege_urls = array_merge($this->privilege_urls,$tmp_urls);
                    }
                }
            }
        }
        return $this->privilege_urls;
    }

    /**
     * 验证登录是否有效，返回 true or  false
     * @return bool
     */
    protected function checkLoginStatus()
    {
        $request = \Yii::$app->request;
        $cookies = $request->cookies;
        $auth_cookie = $cookies->get($this->auth_cookie_name);
        if (!$auth_cookie) {
            return false;
        }
        list($auth_token, $uid) = explode("#", $auth_cookie);

        if (!$auth_token || !$uid) {
            return false;
        }
        if ($uid && preg_match("/^\d+$/", $uid)) {
            $userinfo = User::findOne(['id' => $uid]);
            if (!$userinfo) {
                return false;
            }
            //校验码
            if ($auth_token != $this->createAuthToken($userinfo['id'], $userinfo['name'], $userinfo['email'], $_SERVER['HTTP_USER_AGENT'])) {
                return false;
            }
            $this->current_user = $userinfo;
            $view = \Yii::$app->view;
            $view->params['current_user'] = $userinfo;
            return true;
        }
        return false;
    }

    //设置登录态cookie
    public function createLoginStatus($userinfo)
    {
        $auth_token = $this->createAuthToken($userinfo['id'], $userinfo['name'], $userinfo['email'], $_SERVER['HTTP_USER_AGENT']);
        $cookies = \Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => $this->auth_cookie_name,
            'value' => $auth_token . "#" . $userinfo['id'],
        ]));
    }

    //用户相关信息生成加密校验码函数
    public function createAuthToken($uid, $name, $email, $user_agent)
    {
        return md5($uid . $name . $email . $user_agent);
    }

    //获取post参数的方法
    public function post($key, $default = "")
    {
        return \Yii::$app->request->post($key, $default);
    }

    //获取get参数的方法
    public function get($key, $default = "")
    {
        return \Yii::$app->request->get($key, $default);
    }

    /**
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return mixed
     */
    protected function renderJSON($data = [], $msg = 'ok', $code = 200)
    {
        header("Content-type:application/json");
        echo json_encode([
            "code" => $code,
            "msg" => $msg,
            "data" => $data,
            "req_id" => uniqid(),
        ]);
        return \Yii::$app->end();//终止请求直接返回
    }

}