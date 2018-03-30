<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', '管理员列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', '确定要删除吗?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'role',
            'username',
            'email:email',
            [
                'attribute' => 'last_login_time',
                'value' => function($model) {
                    return date('Y/m/d H:i:s', $model->last_login_time);
                }
            ],
            [
                    'attribute' => 'last_login_ip',
                    'format' => 'raw',
                    'value' => function($model) {
                        $ip = long2ip($model->last_login_ip);
                        return Html::a($ip,"https://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=1&rsv_idx=2&tn=baiduhome_pg&wd=$ip",['target'=>'_blank']);
                    }
            ],
            [
                    'attribute' => 'status',
                    'value' => function($model) {
                        $status = ['禁用','启用'];
                        return $status[$model->status];
                    }
            ],
            [
                    'attribute' => 'created_at',
                    'value' => function($model) {
                        return date('Y/m/d H:i:s', $model->created_at);
                    }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('Y/m/d H:i:s', $model->updated_at);
                }
            ],

        ],
    ]) ?>

</div>
