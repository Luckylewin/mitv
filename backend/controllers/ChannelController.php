<?php

namespace backend\controllers;

use common\models\AppToChannel;
use Yii;
use common\models\Channel;
use common\models\search\ChannelSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChannelController implements the CRUD actions for Channel model.
 */
class ChannelController extends BaseController
{


    /**
     * Lists all Channel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChannelSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['pid' => Yii::$app->request->get('pid',0)]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Channel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Channel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Channel();

        if (Yii::$app->request->isPost) {

            $appToChannel = new AppToChannel();
            $data = Yii::$app->request->post($model->formName());
            $names = preg_split("/\n/", $data['name']);
            if (!empty($data['app_id']) || $data['pid'] != 0) {

                foreach ($names as $name) {
                    $_model = clone $model;
                    $_model->setAttributes([
                        'area_id' => $data['area_id'],
                        'name' => $name,
                        'pid' => $data['pid'],
                    ]);
                    $_model->save(false);

                    if ($data['pid'] == 0) {
                        foreach ($data['app_id'] as $app_id) {
                            if ($data['pid'] == 0) {
                                $_appToChannel = clone $appToChannel;
                                $_appToChannel->setAttributes([
                                    'app_id' => $app_id,
                                    'channel_id' => $_model->id
                                ]);
                                $_appToChannel->save(false);
                            }
                        }
                    }
                }

                Yii::$app->session->setFlash('success', '添加成功');
                return $this->redirect(['channel/index']);
            }
            Yii::$app->session->setFlash('error', '请勾选APP');
            return $this->goBack(Yii::$app->request->referrer);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Channel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $app_id = ArrayHelper::getColumn(AppToChannel::find()->select('app_id')->where(['channel_id' => $model->pid ? $model->pid : $model->id])->asArray()->all(), 'app_id');
        $model->app_id = $app_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Channel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Channel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Channel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Channel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
