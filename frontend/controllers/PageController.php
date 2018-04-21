<?php

namespace frontend\controllers;

use common\models\Page;
use yii\web\NotFoundHttpException;

class PageController extends \yii\web\Controller
{
    public function actionView($id)
    {
        $page = Page::findOne($id);
        if (is_null($page)) {
            throw new NotFoundHttpException("很抱歉,找不到相关内容");
        }

        return $this->render('view',[
            'page' => $page
        ]);
    }

}
