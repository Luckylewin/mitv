<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','queue'],
    'controllerNamespace' => 'console\controllers',
    'components' => [

        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'queue' => [
            'class' => \yii\queue\file\Queue::className(),
            /*'as log' => \yii\queue\LogBehavior::className(),*/
            'path' => '@webroot/storage/runtime/queue',
        ],
        //
        'urlManager' => [
            'scriptUrl' => 'http://47.90.40.108:8088/index.php',
            'enablePrettyUrl' => false,  //开启url规则
            'showScriptName' => true,  //是否显示url中的index.php
            'suffix' => '.html',    //后缀
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];
