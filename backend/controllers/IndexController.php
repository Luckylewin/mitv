<?php
namespace backend\controllers;

use backend\models\LoginForm;
use Yii;

class IndexController extends BaseController
{

    public function actionFrame()
    {
        $this->layout = false;
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRolesByUser(Yii::$app->user->id);

        return $this->render('frame', [
            'username' => Yii::$app->user->identity->username,
            'rolename' => current($role)->name
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 后台登录
     */
    public function actionLogin()
    {
        $this->layout = false;
        if (!Yii::$app->user->isGuest) return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) return $this->goBack();
        else return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * 退出登录
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
