<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Activate';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to activate:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label( Html::a('<font style="color: black">MAC</font> <font style="font-size: 14px;">(FAQ: how can I find the mac?)</font>',\yii\helpers\Url::to(['page/view','id'=>'1']),[
                        'class' => 'btn btn-link'
                    ])) ?>

                <?php $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'email')->label('&nbsp;&nbsp;Your Email') ?>

                <div class="form-group">
                    <?= Html::submitButton('activate', [
                            'class' => 'btn btn-primary',
                            'name' => 'signup-button',

                    ]) ?>

                    <?php Html::a('I have account, go to login',['site/login'], ['class' => 'btn btn-dark', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php \common\widgets\Jsblock::begin() ?>
<script>
        $('#signupform-username').keyup(function (){
           var val = $(this).val();
           var url = '<?= \yii\helpers\Url::to(['site/judge'])?>' + '&user=' + val;
           $.getJSON(url,{},function(d) {
               if (d.code == '0') {
                   $('.field-signupform-email').slideUp();
                   $('#signupform-email').val(d.data.email);
                  // $('#submit').text('login directly');
               } else {
                   $('.field-signupform-email').slideDown();
                   $('#signupform-email').val('');
                   //$('#submit').text('activate');
               }
           }) ;
        });
</script>
<?php \common\widgets\Jsblock::end() ?>
