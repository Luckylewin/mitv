<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Order;
use \yii\bootstrap\Html as bootstrapHtml;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'invoice_number',
            'mac',
            'app_name',
            //'name',
            //'active_time',
            //'expire_time',

            [
	            'attribute' => 'type',
		        'filter' => bootstrapHtml::activeDropDownList($searchModel, 'type', Order::$payPeriod, [
		              'prompt' => '全部',
                      'class' => 'form-control'
                ]),
		        'value' => function($model) {
			        return $model->getTypeStatus();
		        },
                'options' => ['style'=>'width:100px;']
	        ],

            [
                'attribute' => 'total',
                'options' => ['style'=>'width:100px;']
            ],

            [
                    'attribute' => 'is_pay',
                    'filter' => bootstrapHtml::activeDropDownList($searchModel, 'is_pay',Order::getPayStatus(),[
                            'prompt' => '全部',
                            'class' => 'form-control'
                    ]),
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->getPayStatusLabel();
                    },
                'options' => ['style'=>'width:110px;']
            ],

             'created_at:date',

            // 'updated_at',

            [
                    'class' => 'common\grid\MyActionColumn',
                    'options' => ['style'=>'width:200px;'],
                    'template' => '{view}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
