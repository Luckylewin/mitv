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
 * @property integer $oid
 */
class ActivateLog extends \yii\db\ActiveRecord
{

    public $app;
    public $type;

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
            'created_time' => Yii::t('frontend', '激活时间'),
            'expire_time' => Yii::t('frontend', '过期时间'),
            'duration' => Yii::t('frontend', '天数'),
            'is_charge' => Yii::t('frontend', '是否收费'),
            'oid' => Yii::t('frontend', '操作用户id'),
        ];
    }

    public function beforeSave($insert)
    {
       if ( parent::beforeSave($insert)) {
            //查询免费天数
           $app = App::findOne($this->app);

           $free_day = $app->free_day;
           $this->expire_time = strtotime("+ $free_day day");
           $this->appname = $app->name;
           $this->duration = $free_day;
           $this->is_charge = 0;
           $this->oid = Yii::$app->user->getId();
           $this->uid = $this->oid;
       }
       return true;
    }

}
