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
use common\models\AppToChannel;
use common\models\Channel;
use common\models\Order;
use common\oss\Aliyunoss;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use Yii;
use yii\web\NotFoundHttpException;

class IndexController extends Controller
{
    public $app;

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            if (in_array($action->id, ['first-activate','activate']) && Yii::$app->user->isGuest) {
                $this->redirect(Url::to(['site/signup','des' => base64_encode(Yii::$app->request->referrer)]));
            }

            if (in_array($action->id, ['purchase','view','show-list','first-activate', 'activate', 'download'])) {
               $id = Yii::$app->request->get('id') ? Yii::$app->request->get('id') : Yii::$app->request->get('app');
               $app = App::findOne($id);
               if (is_null($app)) {
                    throw new ForbiddenHttpException("404 Page Not Found");
               }
               $this->app = $app;
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
        return $this->render('view', [
            'app' => $this->app,
        ]);
    }

    public function actionPurchase($app)
    {
        $app = $this->app;
        //查找用户是否已经激活免费过该APP
        $log = ActivateLog::findOne([
            'uid' => Yii::$app->user->getId(),
            'is_charge' => '0',
            'appname' => $app->name
        ]);

        return $this->render('purchase', [
            'app' => $app,
            'free_chance' => is_null($log)? true : false
        ]);
    }

    public function actionFirstActivate($type, $app)
    {
        $app = $this->app;

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
            Yii::$app->session->setFlash('success', 'Your account will be opened in 24 hours, Please pay attention to the mailbox');
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

        $app = $this->app;
        //查找用户是否已经激活免费过该APP
        $log = ActivateLog::findOne([
            'uid' => Yii::$app->user->getId(),
            'is_charge' => '0',
            'appname' => $app->name
        ]);

       /* if (is_null($log)) {
            //说明是第一次激活使用
            return $this->redirect(Url::to(['index/first-activate','type'=>'0','app'=>$app->id]));
        }*/

        $model = new Order();
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                return \Yii::$app->response->redirect(['index/order','order'=>$model->invoice_number]);
            }
        }

        $price = $options[$type];
        $duration = $durations[$type];
        $mac = Yii::$app->user->isGuest ? 'visitor' : Yii::$app->user->identity->username;

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
        $channel_id = AppToChannel::find()->select('channel_id')->where(['app_id' => $this->app->id])->asArray()->all();

        if (!empty($channel_id)) {
            $channel_id = ArrayHelper::getColumn($channel_id,'channel_id');

            $data = Channel::getIntroduceList($channel_id);
        } else {
            $data = [];
        }


        return $this->render('list', [
            'data' => $data,
            ''
        ]);
    }

    public function actionDownload($app)
    {
        $app = $this->app;
        return $this->redirect(Aliyunoss::getDownloadUrl($app->url));
    }



}
