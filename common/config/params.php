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
    ]

];
