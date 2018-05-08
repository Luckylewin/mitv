<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/5/7
 * Time: 17:54
 */

namespace console\controllers;

use yii\console\Controller;
use Yii;

class MailController extends Controller
{
    public function actionSend()
    {
        Yii::$app->mailer->compose( ['html'=>'notice-html', 'text'=>'notice-text'],
                                    ['message' => '恭喜注册成功']
                         )->setTo('876505905@qq.com')
                          ->setSubject('My Test Message')
                          ->setTextBody('My Text Body')
                          ->send();
    }

}