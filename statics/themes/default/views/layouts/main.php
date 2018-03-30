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

<?php if(Yii::$app->user->isGuest): ?>


<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-5 mb-4 bg-white border-bottom box-shadow" >
   <a href="<?= Url::to(['index/view','id'=>1])?>" class="btn btn-primary btn-lg btn-block">Pay For App</a>
</div>


<?php else: ?>

    <nav class="navbar navbar-expand-md bg-primary navbar-dark p-3 px-md-5 mb-4 ">
        <a class="navbar-brand" href="/"><b>TV APP</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['index/show-list']) ?>">Channel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['site/contact']) ?>">About</a>
                </li>
                <li class="nav-item dropdown pull-right">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <?= Yii::$app->user->identity->username; ?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">My Account</a>
                        <a class="dropdown-item" href="<?php echo Url::to(['site/logout']) ?>">logout</a>
                    </div>
                </li>
            </ul>
        </div>

<!--        -->
<!--        -->

    </nav>
<?php endif; ?>

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
