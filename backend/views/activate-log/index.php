<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\App;
use \common\models\ActivateLog;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ActivateLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activate Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activate-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'is_charge',
                'filter' => ActivateLog::$chargeStatus,
                'value' => function($model) {
                    if ($model->order_id) {

                    }
                    return ActivateLog::$chargeStatus[$model->is_charge];
                }
            ],

            [
                'attribute' =>  'appname',
                'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'appname',ArrayHelper::map(App::getApp(),'name', 'name'), [
                        'class' => 'form-control',
                        'prompt' => '请选择',
                ]),
                'value' => function($model) {
                    return $model->appname;
                }
            ],

            [
                    'attribute' => 'uid',
                    'filter' => false,
                    'value' => function($model) {
                        return $model->user->username;
                    }
            ],
            [
                    'attribute' => 'duration',
                    'filter' => false,
            ],

            [
                'attribute' => 'order_id',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->order_id) {
                        $order = $model->order;
                        return isset($order->invoice_number)? Html::a($order->invoice_number, ['order/view', 'id' => $model->order_id]) : '已删除';
                    }
                    return "-";
                }
            ],

            'created_time:datetime',
            [
                'attribute' => 'is_deal',
                'format' => 'raw',
                'filter' => ActivateLog::$dealStatus,
                'value' => function($model) {
                    return $model->getDealStatusLabel();
                }
            ],

            [
                    'class' => 'common\grid\MyActionColumn',
                    'template' => '{activate}',
                    'buttons' => [
                            'activate' => function($url, $model, $key){

                                return Html::a("激活",\yii\helpers\Url::to(['activate-log/activate', 'id'=>$model->id]),[
                                        'class' => 'btn btn-default',
                                        'disabled' => $model->is_deal ? true : false
                                ]);
                            }
                    ]
            ],
        ],
    ]); ?>
</div>
