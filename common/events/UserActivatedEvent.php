<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/5/8
 * Time: 10:52
 */

namespace common\events;


use yii\base\Event;

class UserActivatedEvent extends Event
{
    public $uid = 0;
    public $appName = "";
}