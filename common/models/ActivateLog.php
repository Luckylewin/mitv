<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sys_activate_log".
 *
 * @property integer $id
 * @property string $appname
 * @property integer $uid
 * @property integer $created_time
 * @property integer $expire_time
 * @property integer $duration
 * @property string $is_charge
 * @property string $is_deal
 * @property integer $oid
 * @property integer $order_id
 */
class ActivateLog extends \yii\db\ActiveRecord
{

    public $app;
    public $type;

    public static $chargeStatus = [
        0 => '免费使用',
        1 => '收费',
    ];

    public static $dealStatus = [
        0 => '未开通',
        1 => '已开通'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_activate_log';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_time',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_time'],
                ],
                'value' => time()
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'app'], 'required'],
            [['uid', 'created_time', 'expire_time', 'duration', 'oid', 'app', 'type'], 'integer'],
            [['appname'], 'string', 'max' => 50],
            [['is_charge'], 'string', 'max' => 1],
            ['is_charge','default', 'value' => '0']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'appname' => Yii::t('frontend', 'Appname'),
            'uid' => Yii::t('frontend', '用户id'),
            'created_time' => Yii::t('frontend', '时间'),
            'expire_time' => Yii::t('frontend', '过期时间'),
            'duration' => Yii::t('frontend', '天数'),
            'is_charge' => Yii::t('frontend', '是否收费'),
            'oid' => Yii::t('frontend', '操作用户id'),
            'order_id' => Yii::t('frontend', '订单id'),
            'is_deal' => Yii::t('frontend', '是否开通'),
        ];
    }

    public function beforeSave($insert)
    {
       if ( parent::beforeSave($insert)) {
            //查询免费天数
           if ($this->is_charge == false && $this->isNewRecord) {
               $this->oid = Yii::$app->user->getId();
               $this->uid = $this->oid;
               $app = App::findOne($this->app);
               $this->appname = $app->name;
               $free_day = $app->free_day;
               $this->expire_time = strtotime("+ $free_day day");
               $this->duration = $free_day;
               $this->is_charge = 0;
           }
       }
       return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(),['id' => 'order_id']);
    }

    /**
     * 用户
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'uid']);
    }

    public function getApp()
    {
        return $this->hasOne(App::className(),['name' => 'appname']);
    }

    public function getDealStatusLabel()
    {
        $color = $this->is_deal ? 'success' : 'warning';
        return '<span class="label label-'. $color .'">'.self::$dealStatus[$this->is_deal] . '</span>';
    }

}
