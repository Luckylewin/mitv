<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yii2_config".
 *
 * @property string $id
 * @property string $keyid
 * @property string $title
 * @property string $data
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yii2_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'required'],
            [['data'], 'string'],
            [['keyid'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyid' => 'Keyid',
            'title' => 'Title',
            'data' => 'Data',
        ];
    }
}
