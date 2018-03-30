<?php
return [
    'adminEmail' => 'admin@example.com',

    'supportEmail' => 'zystyle@foxmail.com',

    'user.passwordResetTokenExpire' => 3600,

    'availableLocales' => [
        'en-US'=>'English (US)',
        'zh-CN' => '简体中文',
    ],

    //阿里云OSS配置
    'OSS' =>[
        'ACCESS_ID'=> '',    //ID
        'ACCESS_KEY' => '', // KEY
        'ENDPOINT'=>'oss-cn-shenzhen.aliyuncs.com',//指定区域
        'BUCKET'=>'',//bucket
    ],

   /* 'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@common/mail',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.qq.com',
            'username' => 'xxxx@foxmail.com',
            'password' => 'xxxxxxxxxx',
            'port' => '465',
            'encryption' => 'ssl',
        ],
        'messageConfig'=>[
            'charset'=>'UTF-8',
            'from'=>['xxxxx@foxmail.com'=>'TV APP'],

        ],
    ],*/



];
