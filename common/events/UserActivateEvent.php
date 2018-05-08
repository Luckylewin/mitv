<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/5/8
 * Time: 10:52
 */

namespace common\events;


use yii\base\Event;

class UserActivateEvent extends Event
{
    public $uid = 0;
    public $title = "";
    public $subject = "";
    public $message = "";
}