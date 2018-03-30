<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "yii2_test".
 *
 * @property integer $id
 * @property string $test
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yii2_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'test'], 'required'],
            [['id'], 'integer'],
            [['test'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test' => 'Test',
        ];
    }
}
