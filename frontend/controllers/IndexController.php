<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/3/26
 * Time: 15:03
 */

namespace frontend\controllers;

use common\models\ActivateLog;
use common\models\App;
use common\models\Order;
use common\oss\Aliyunoss;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use Yii;
use yii\web\NotFoundHttpException;

class IndexController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            if (in_array($action->id, ['view','first-activate']) && Yii::$app->user->isGuest) {
                return $this->redirect(Url::to(['site/signup','des' => base64_encode(Yii::$app->request->referrer)]));
            }
        }
        return true;
    }

    public function actionIndex()
    {

        $app = App::find()->all();

        return $this->render('index',[
            'app' => $app
        ]);
    }

    public function actionView($id)
    {
        $app = App::findOne($id);
        if (is_null($app)) {
            throw new ForbiddenHttpException("404 Page Not Found");
        }

        //查找用户是否已经激活免费过该APP
        $log = ActivateLog::findOne([
            'uid' => Yii::$app->user->getId(),
            'is_charge' => '0',
            'appname' => $app->name
        ]);

        if (is_null($log)) {
            //说明是第一次激活使用
            return $this->redirect(Url::to(['index/first-activate','type'=>'0','app'=>$app->id]));
        }

        return $this->render('view', [
            'app' => $app,
        ]);
    }

    public function actionFirstActivate($type, $app)
    {
        $app = App::findOne($app);
        if (is_null($app)) {
            throw new ForbiddenHttpException("404 Page Not Found");
        }

        //查找用户是否已经激活免费过该APP
        $log = ActivateLog::findOne([
            'uid' => Yii::$app->user->getId(),
            'is_charge' => '0',
            'appname' => $app->name
        ]);

        if (!is_null($log)) {
            //说明是已经激活使用了
            Yii::$app->session->setFlash('error', 'Sorry, Only Free Activation Once');
            return $this->redirect(Url::to(['index/view', 'id' => $app->id]));
        }

        $model = new ActivateLog();

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', 'sorry, an unexpected error occur');
                return $this->goBack(Yii::$app->request->referrer);
            }
            Yii::$app->session->setFlash('success', 'Congratulation, You have activate Your account successfully');
        }

        return $this->render('first-activate', [
            'model' => $model,
            'app' => $app,
        ]);
    }

    public function actionActivate($type, $app)
    {
        $options = ['1'=>'month_price', '3'=>'season_price', '6'=>'half_price', '12' => 'year_price'];
        $durations = ['1'=>'1 month', '3'=>'3 month', '6'=>'half year', '12' => '1 year'];

        $app = App::findOne($app);

        if (is_null($app) || !isset($options[$type])) {
            throw new ForbiddenHttpException("404 Page Not Found");
        }

        $model = new Order();
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                return \Yii::$app->response->redirect(['index/order','order'=>$model->invoice_number]);
            }
        }

        $price = $options[$type];
        $duration = $durations[$type];
        $mac = Yii::$app->user->identity->username;

        return $this->render('activate', [
            'model' => $model,
            'mac' => $mac,
            'app' => $app,
            'price' => $app->$price,
            'duration' => $duration
        ]);
    }

    public function actionOrder($order)
    {

        $order = Order::findOne(['invoice_number' => $order]);
        if (is_null($order)) {
            throw new ForbiddenHttpException("页面发生错误",404);
        }

        return $this->render('order',[
            'order' => $order
        ]);
    }

    public function actionSuccess($order)
    {
        $order = Order::findOne(['invoice_number' => $order]);

        return $this->render('success',[
            'order' => $order
        ]);
    }

    public function actionShowList($app)
    {
        return $this->render('list');
    }

    public function actionDownload($app)
    {
        $app = App::findOne($app);
        if (is_null($app) || $app->url == '') {
            throw  new NotFoundHttpException('sorry , we miss the download url');
        }
        return $this->redirect(Aliyunoss::getDownloadUrl($app->url));
    }



}
