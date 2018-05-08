<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\OssUploader;

/* @var $this yii\web\View */
/* @var $model common\models\App */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= OssUploader::widget([
        'model' => $model,
        'form' => $form,
        'field' => 'imgae',
        'allowExtension' => [
            'image file' => 'png,jpg'
        ]
    ]); ?>

    <?= $form->field($model, 'short_introduce')->widget(\yii\redactor\widgets\Redactor::className(),
        [
            'clientOptions' => [
                'imageManagerJson' => ['/redactor/upload/image-json'],
                'imageUpload' => ['/redactor/upload/image'],
                'fileUpload' => ['/redactor/upload/file'],
                'lang' => 'zh_cn',
                'plugins' => ['clips', 'fontcolor'],

            ]
        ]) ?>

    <?= $form->field($model, 'month_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'season_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'half_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'free_day')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'introduce')->widget(\yii\redactor\widgets\Redactor::className(),
        [
            'clientOptions' => [
                'minHeight' =>'300px',
                'imageManagerJson' => ['/redactor/upload/image-json'],
                'imageUpload' => ['/redactor/upload/image'],
                'fileUpload' => ['/redactor/upload/file'],
                'lang' => 'zh_cn',
                'plugins' => ['clips', 'fontcolor','imagemanager'],

            ]
        ]) ?>

    <?= $form->field($model, 'faq')->widget(\yii\redactor\widgets\Redactor::className(),
        [
            'clientOptions' => [
                'minHeight' =>'300px',
                'imageManagerJson' => ['/redactor/upload/image-json'],
                'imageUpload' => ['/redactor/upload/image'],
                'fileUpload' => ['/redactor/upload/file'],
                'lang' => 'zh_cn',
                'plugins' => ['clips', 'fontcolor','imagemanager'],

            ]
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
