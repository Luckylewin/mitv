<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mac') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'active_time') ?>

    <?= $form->field($model, 'expire_time') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'app_name') ?>

    <?php // echo $form->field($model, 'invoice_number') ?>

    <?php // echo $form->field($model, 'is_pay') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
