<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->mac;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mac',
            //'name',
            /*'active_time',
            'expire_time',*/
            'type',
            'total',
            'app_name',
            'invoice_number',
            'is_pay',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php if (strpos(Yii::$app->request->referrer, 'log') !== false):?>
            <?= Html::a('返回', Yii::$app->request->referrer, ['class' => 'btn btn-default']) ?>
        <?php else: ?>
            <?= Html::a('返回', ['order/index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?>
    </p>

</div>
