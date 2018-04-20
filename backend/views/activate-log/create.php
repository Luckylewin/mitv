<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActivateLog */

$this->title = 'Create Activate Log';
$this->params['breadcrumbs'][] = ['label' => 'Activate Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activate-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
