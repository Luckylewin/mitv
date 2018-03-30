<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\web\AssetBundle as AppAsset;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <title>TV App Store</title>
    <!-- Bootstrap core CSS -->
    <link href="/statics/components/bootstrap-4.0/css/bootstrap.min.css" rel="stylesheet">
    <?php $this->registerJsFile('/statics/components/bootstrap-4.0/js/bootstrap.bundle.min.js',['depends' => 'yii\web\JqueryAsset']) ?>
    <link href="/statics/themes/default/views/css/site.css" rel="stylesheet">

</head>
<?php $this->head() ?>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-5 mb-4 bg-white border-bottom box-shadow" >
    <!--<h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">TV APP</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="/">APP</a>
        <a class="p-2 text-dark" href="/">Support</a>
        <a class="p-2 text-dark" href="/">ABOUT</a>
    </nav>-->

    <?php if(Yii::$app->user->isGuest): ?>
	
        <a href="<?= Url::to(['index/view','id'=>1])?>" class="btn btn-primary btn-lg btn-block">Pay For App</a>
	<!--
	
    <nav class="my-2 my-md-0 mr-md-3">
	<a class="btn btn-outline-primary" href="<?= Url::to(['site/signup']) ?>">Signup</a>
        &nbsp;
        <a class="btn btn-outline-primary" href="<?= Url::to(['site/login']) ?>">Login</a>
    </nav>
	-->
    <?php else: ?>
        <div class="dropdown open my-dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= Yii::$app->user->identity->username ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu1" >
                <a class="dropdown-item" href="#">Cart</a>
                <a class="dropdown-item" href="#">My APP</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= Url::to(['site/logout']) ?>">logout</a>
            </div>
        </div>
    <?php endif; ?>
</div>


<?php $this->beginBody() ?>
<body class="bg-light">
<div class="wrap">
    <div class="container">
        <?= \common\widgets\Alert::widget() ?>
        <div class="content">
            <?= $content ?>
        </div>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
                    <small class="d-block mb-3 text-muted">&copy;2018 TV App All Rights Reserved.</small>
                </div>

                <div class="col-6 col-md" style="display:none">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Channel List</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md" style="display:none">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Locations</a></li>
                    </ul>
                </div>

            </div>
        </footer>
    </div>
</div>

<?php $this->endBody() ?>
<?php $this->endPage() ?>

</body>
</html>
