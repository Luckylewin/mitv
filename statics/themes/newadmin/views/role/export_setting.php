<?php

use \yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = '导出设置';
$this->params['breadcrumbs'][] = ['label' => '管理员设置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="role-create">

    <?php $form = \yii\widgets\ActiveForm::begin([
            'method' => 'post',
            'action' => \yii\helpers\Url::to(['excel-setting/update']),
    ]); ?>

    <?= \yii\helpers\Html::hiddenInput($settingModel->formName() . '[rolename]', $model->name); ?>

    <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'description',
                    [
                            'attribute' => 'export_setting',
                            'format' => 'raw',
                            'label' => '单项实付与实付合计',
                            'value' => function($model) use($settingModel,$form) {
                                   return $form->field($settingModel,'showfinance')->dropDownList(\common\models\Type::getExportSetting(), [
                                           'style' => 'width:100px;'
                                   ])->label(false);
                            }
                    ]
                ]
        ]);
    ?>

    <p>
          <?= \yii\helpers\Html::submitButton("保存", ['class'=>'btn btn-info']) ?>
          <?= \yii\helpers\Html::a("返回", ['role/index'], ['class'=>'btn btn-default']); ?>
    </p>

    <?php \yii\widgets\ActiveForm::end(); ?>

</div>
