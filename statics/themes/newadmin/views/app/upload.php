<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\App */

$this->title = 'APK文件上传';
$this->params['breadcrumbs'][] = ['label' => 'Apps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="app-form">

        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'method' => 'post',
            'action' => \yii\helpers\Url::to(['app/upload', 'id' => $model->id])
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly' => true]) ?>

        <?= \common\widgets\OssUploader::widget([
            'model' => $model,
            'form' => $form,
            'field' => 'url',
            'allowExtension' => [
                'image file' => 'apk'
            ]
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php \yii\bootstrap\ActiveForm::end(); ?>

    </div>


</div>
