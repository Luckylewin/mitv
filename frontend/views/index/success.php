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
        <h2>Congratulation!</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <table class="table table-inverse">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Mac</th>
                    <th>App Name</th>
                    <th>Type</th>
                    <th>Charge</th>
                    <th>PayTime</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td><?= $order->invoice_number ?></td>
                    <td><?= $order->mac ?></td>
                    <td><?= $order->app_name ?></td>
                    <td><?= $order->type ?> month</td>
                    <td><b>$<?= $order->total ?></b></td>
                    <td><b><?= $order->updated_at ?></b></td>
                </tr>
                </tbody>
            </table>
            <hr class="mb-4">
            <button class="btn btn-success btn-lg btn-block pay-now" type="button"><i><b>Congratulation,Activate it Successfully!</b></i></button>

        </div>
    </div>








