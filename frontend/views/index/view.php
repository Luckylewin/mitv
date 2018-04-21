<?php
use yii\helpers\Url;

$this->registerCssFile('/statics/themes/newadmin/css/font-awesome.min.css');
?>

<link href="/statics/themes/default/views/css/price.css?v=20180403" rel="stylesheet">
<style>
    .content{background: linear-gradient(to right, #f3d08e , #afeb86);padding: 47px 40px; }
</style>

<div class="row">

    <div>
        <?= isset($app->introduce)?$app->introduce:''; ?>
    </div>
</div>

<div class="container-fluid phone-btn">

    <div class="row">
        <div style="margin:30px auto 10px">
            <a href="<?= Url::to(['index/show-list','app'=>$app->id]) ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Channels</a>
            <a href="<?= Url::to(['index/purchase','app'=>$app->id]) ?>" class="btn btn-primary btn-sm"><i class="fa fa-key"></i> Activate</a>
            <a href="<?= Url::to(['index/download','app'=>$app->id]) ?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a>
        </div>
    </div>
</div>

<div class="container-fluid pc-btn" style="display: none">
    <div class="row">
        <div style="margin:30px auto 10px">
            <a href="<?= Url::to(['index/show-list','app'=>$app->id]) ?>" class="btn btn-info btn-lg"><i class="fa fa-list"></i> Channels</a>
            <a href="<?= Url::to(['index/purchase','app'=>$app->id]) ?>" class="btn btn-primary btn-lg"><i class="fa fa-key"></i> Activate</a>
            <a href="<?= Url::to(['index/download','app'=>$app->id]) ?>" class="btn btn-success btn-lg"><i class="fa fa-download"></i> Download</a>
        </div>
    </div>
</div>

<?php \common\widgets\Jsblock::begin(); ?>
<script>
    $(function(){
        var ua = navigator.userAgent.toLowerCase();
        if (!(ua.indexOf('iphone') == -1 && ua.indexOf('ipad') ==-1 && ua.indexOf('android') ==-1)){
            $('.phone-btn').show();
        } else {
            $('.pc-btn').show();
            $('.phone-btn').hide();
        }
    })
</script>
<?php \common\widgets\Jsblock::end(); ?>




