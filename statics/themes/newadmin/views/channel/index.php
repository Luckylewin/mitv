<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ChannelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Channels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'sort',
            //'pid',
            //'image',
            // 'area_id',

            [
                    'class' => 'common\grid\MyActionColumn',
                    'template' => '{childes} {view} {update} {delete}',
                    'buttons' => [
                            'childes' => function($url, $model, $key) {
                                if ($model->pid  != 0) {
                                    return '';
                                }
                                return Html::a('子频道列表', \yii\helpers\Url::to(['channel/index', 'pid' => $model->id]), [
                                        'class' => 'btn btn-default btn-xs'
                                ]);
                            }
                    ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<p>
    <?= Html::a('Create Channel', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Back', \yii\helpers\Url::to(['channel/index']), ['class' => 'btn btn-default']) ?>
</p>
