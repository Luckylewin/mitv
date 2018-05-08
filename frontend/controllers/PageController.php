<?php

namespace frontend\controllers;

use common\models\App;
class PageController extends \yii\web\Controller
{
    public function actionView($id)
    {

        $app = App::find()->asArray()->all();

        return $this->render('view',[
            'app' => $app
        ]);
    }

}
