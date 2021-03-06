<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('YII_ENV_TEST') or define('YII_ENV_TEST', 'test');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/common/config/bootstrap.php');
require(__DIR__ . '/frontend/config/bootstrap.php');

if (YII_ENV_TEST) {
    $config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/common/config/main.php'),
        require(__DIR__ . '/common/config/main-local.php'),
        require(__DIR__ . '/frontend/config/main.php')
    );
}else {
    $config = yii\helpers\ArrayHelper::merge(
        require(__DIR__ . '/common/config/main.php'),
        require(__DIR__ . '/frontend/config/main.php')
    );
}



//var_dump($config);exit();
$config['components']['view'] = [
    'theme' => [
        'basePath' => '@statics/themes/default',
        'baseUrl' => '@statics/themes/default',
        'pathMap' => [
            '@frontend/views' => [
                //'@statics/themes/' . $currentTheme . '/views',
                '@statics/themes/' . 'default' . '/views',
            ],
        ],
    ],
];

if (0 && !YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

(new yii\web\Application($config))->run();
