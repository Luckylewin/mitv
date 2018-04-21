<?php

namespace frontend\controllers;

use common\models\ActivateLog;
use common\models\search\ActivateLogSearch;
use Yii;

class MemberController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (Yii::$app->user->isGuest) {
                return $this->goHome();
            }
        }
        return true;
    }

    public function actionIndex()
    {
        //查找用户的激活数据
        $searchModel = new ActivateLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, [
            'uid' => Yii::$app->user->getId()
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

}
