<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_app_channel".
 *
 * @property integer $app_id
 * @property integer $channel_id
 */
class AppToChannel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_app_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_id', 'channel_id'], 'required'],
            [['app_id', 'channel_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'app_id' => Yii::t('frontend', 'App ID'),
            'channel_id' => Yii::t('frontend', 'Channel ID'),
        ];
    }
}
