<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
?>

<ul>
    <?php foreach ($app as $_app): ?>
    <li><a href="<?= Url::to(['index/faq', 'id' => $_app['id']]) ?>"><?= $_app['name'] ?></a></li>
    <?php endforeach; ?>
</ul>