<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/4/20
 * Time: 18:53
 */
use yii\grid\GridView;
use common\models\ActivateLog;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use common\models\App;

$this->registerCssFile('/statics/themes/newadmin/css/font-awesome.min.css');
?>

<div class="container">
    <h2>Activate History</h2>
    <p>include the free use App:</p>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>App Name</th>
                <th>Order</th>
                <th>Charge</th>
                <th>Duration</th>
                <th>ExpireDate</th>
                <th>Date</th>
                <th>Is Open</th>
            </tr>
            </thead>
            <tbody>

            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'layout' => '{items}{pager}'
            ])
            ?>

            </tbody>
        </table>
    </div>

</div>

