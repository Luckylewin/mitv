<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\App */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= \common\widgets\OssUploader::widget([
        'model' => $model,
        'form' => $form,
        'field' => 'imgae',
        'allowExtension' => [
            'image file' => 'png,jpg'
        ]
    ]); ?>

    <?= $form->field($model, 'introduce')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'month_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'season_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'half_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'free_day')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
