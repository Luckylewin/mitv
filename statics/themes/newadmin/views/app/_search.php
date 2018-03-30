<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AppSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'introduce') ?>

    <?= $form->field($model, 'month_price') ?>

    <?php // echo $form->field($model, 'season_price') ?>

    <?php // echo $form->field($model, 'half_price') ?>

    <?php // echo $form->field($model, 'year_price') ?>

    <?php // echo $form->field($model, 'free_day') ?>

    <?php // echo $form->field($model, 'imgae') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
