<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/5/8
 * Time: 13:54
 */

namespace common\queue;

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class SendMail extends BaseObject implements JobInterface
{
    public $username;
    public $subject;
    public $message;
    public $email;
    public $html;
    public $text;

    public function execute($queue)
    {
        try{
            Yii::$app->mailer->compose(['html'=>$this->html, 'text'=>$this->text],
                                       ['message' => $this->message]
               )->setTo($this->email)
                ->setSubject($this->subject)
                ->send();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }

}