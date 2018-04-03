<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\App;
use yii\helpers\ArrayHelper;
use common\models\Channel;
use common\models\Country;
/* @var $this yii\web\View */
/* @var $model common\models\Channel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="channel-form">

    <?php $form = ActiveForm::begin(); ?>



    <?php if(Yii::$app->request->get('area_id')) $model->area_id = Yii::$app->request->get('area_id'); ?>

    <?= $form->field($model, 'area_id')->dropDownList(ArrayHelper::map(Country::getCountry(),'id', 'zh_name'),[
            'prompt' => '请选择'
    ]) ?>

    <?php if(Yii::$app->request->get('area_id') || !$model->isNewRecord) echo $form->field($model, 'pid')->dropDownList(ArrayHelper::map(Channel::getClass(Yii::$app->request->get('area_id')),'id', 'name'),[
        'prompt' => '请选择'
    ])->label('分类') ?>



        <div class="well" style="display: none">
            <?= $form->field($model, 'app_id')->checkboxList(ArrayHelper::map(App::getApp(),'id', 'name'))->label('支持的APP') ?>
        </div>



    <?php if($model->isNewRecord): ?>
    <?= $form->field($model, 'name')->textarea([
            'rows' => 10
    ])->label('节目名称(批量添加)') ?>
    <?php else: ?>
        <?= $form->field($model, 'name')->textInput()->label('节目名称') ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \common\widgets\Jsblock::begin() ?>
<script>
    $('#channel-area_id').change(function(){
       var val = $(this).val();
       var url = '<?= \yii\helpers\Url::to(['channel/create', 'area_id' => '']) ?>';
       window.location.href = url + val;
    });
    $('#channel-pid').change(function(){
       var val = $(this).val();
       if (val == '0') {
           $('.well').css('display', 'block');
       }else {
           $('.well').css('display', 'none');
       }
    });
</script>
<?php \common\widgets\Jsblock::end() ?>
