<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SysUser */
/* @var $form ActiveForm */
?>



<div class="py-5 text-center">
    <h2>Activate Account</h2>
</div>

<div class="row">
    <table class="table table-hover table-striped">
        <tbody>
        <tr>
            <th>APP Name</th>
            <td><?= $app->name; ?></td>
        </tr>
        <tr>
            <th>Free For Use</th>
            <td><?= $app->free_day ?> days</td>
        </tr>
        <tr>
            <th>Expire Date</th>
            <td><?= date('Y/m/d', strtotime("+ " . $app->free_day .' day'));?></td>
        </tr>
        <tr>
            <th>Your Mac</th>
            <td><?= Yii::$app->user->isGuest?'':Yii::$app->user->identity->username;?></td>
        </tr>
        </tbody>
    </table>
    <div class="col-lg-12">
<!--        <h4 class="mb-3">Please submit your mac</h4>-->
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'type')->hiddenInput(['value' => Yii::$app->request->get('type')])->label(false); ?>
        <?= $form->field($model, 'app')->hiddenInput(['value' => Yii::$app->request->get('app')])->label(false); ?>

        <div class="mb-12">
            <?= $form->field($model, 'username')->hiddenInput(['value'=>Yii::$app->user->isGuest?'':Yii::$app->user->identity->username,'readonly'=>true])->label(false); ?>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Activating Now!</button>
        <?php Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
