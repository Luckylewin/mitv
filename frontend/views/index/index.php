
<div class="card-deck mb-3 text-center">
        <?php foreach($app as $_app): ?>
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal"><?= $_app->name; ?></h4>
            </div>
            <div class="card-body">

                <ul class="list-unstyled mt-3 mb-4">
                    <a href="<?= \yii\helpers\Url::to(['index/view', 'id' => $_app->id]) ?>">
                        <img class="app-img" src="<?= \common\oss\Aliyunoss::getDownloadUrl($_app->imgae) ?>" alt="">
                    </a>
                </ul>
                <ul class="list-unstyled mt-3 mb-4">
                    <?= $_app->short_introduce ?>
                </ul>
                <a href="<?= \yii\helpers\Url::to(['index/view', 'id' => $_app->id]) ?>">
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary">Free for <?= $_app->free_day ?> day</button>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
</div>


