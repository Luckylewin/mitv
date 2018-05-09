<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/5/8
 * Time: 10:44
 */

namespace common\components;

use common\events\UserActivatedEvent;
use common\events\UserActivateEvent;
use common\models\User;
use common\queue\SendMail;
use Yii;

class mailer
{
    public static function activateNotification(UserActivateEvent $event)
    {
        $userId = $event->uid;
        $user = User::findOne($userId);
        $subject = "Operation Notification";

        Yii::$app->queue->push(new SendMail([
            "html" => 'notice-html',
            "text" => 'notice-text',
            "subject" => $subject,
            'username' => $user->username,
            'message' => "The account \"{$user->username}\" will be activated within 24 hours. <br/>Thanks for your support.",
            'email' => $user->email
        ]));
    }

    static public function activatedNotification(UserActivatedEvent $event)
    {
        $userId = $event->uid;
        $user = User::findOne($userId);

        $appName = $event->appName;
        $subject = "Activated Notification";
        $message = "Congratulations! Your account has been activated on {$appName} .<br/>Enjoy Your Time.";

        Yii::$app->queue->push(new SendMail([
            "html" => 'activated-html',
            "text" => 'notice-text',
            "subject" => $subject,
            'username' => $user->username,
            'message' => $message,
            'email' => $user->email
        ]));
    }

}