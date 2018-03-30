<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\AssetBundle as AppAsset;
/* @var $this yii\web\View */
/* @var $model common\models\SysUser */
/* @var $form ActiveForm */
AppAsset::register($this);
$this->registerJsFile('/statics/components/layer/layer-v3.1.1.js',['depends'=>'yii\web\JqueryAsset'])
?>

<!doctype html>
<div class="container">
    <div class="py-5 text-center">
        <h2><?= $order->invoice_number; ?></h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
                     'id' => 'payform',
                    'method' => 'get',
                    'action' => \yii\helpers\Url::to(['pay/create','order' => $order->invoice_number])
            ]); ?>
            <table class="table table-inverse">
                <thead>
                <tr>
                    <th>Mac</th>
                    <th>App Name</th>
                    <th>Type</th>
                    <th>Charge</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td><?= $order->mac ?></td>
                    <td><?= $order->app_name ?></td>
                    <td><?= $order->type ?> month</td>
                    <td><b>$<?= $order->total ?></b></td>
                </tr>
                </tbody>
            </table>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block pay-now" type="submit"><i>Checkout using <b>PayPal</b></i></button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


    <?php \common\widgets\Jsblock::begin() ?>
<script>
    $('.pay-now').click(function(){
        $(this).prop('disabled', true);
        layer.msg("Calling PayPal Now",{time: 3000,offset:['250px', '']});
        var index = layer.load(1, {
            shade: [0.5,'#000'] //0.1透明度的白色背景
        });
        $('#payform').submit();
    });
</script>
    <?php \common\widgets\Jsblock::end() ?>





