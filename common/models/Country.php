<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ds_country".
 *
 * @property integer $id
 * @property string $name
 * @property string $zh_name
 * @property string $code
 * @property string $code2
 * @property integer $is_show
 * @property integer $sort
 * @property string $commonpic
 * @property string $hoverpic
 * @property string $is_common
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ds_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'zh_name'], 'required'],
            [['is_show', 'sort'], 'integer'],
            [['name', 'zh_name'], 'string', 'max' => 50],
            [['code', 'code2'], 'string', 'max' => 5],
            [['commonpic', 'hoverpic', 'is_common'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'name' => Yii::t('frontend', 'Name'),
            'zh_name' => Yii::t('frontend', 'Zh Name'),
            'code' => Yii::t('frontend', 'Code'),
            'code2' => Yii::t('frontend', 'Code2'),
            'is_show' => Yii::t('frontend', '是否显示'),
            'sort' => Yii::t('frontend', 'Sort'),
            'commonpic' => Yii::t('frontend', 'Commonpic'),
            'hoverpic' => Yii::t('frontend', 'Hoverpic'),
            'is_common' => Yii::t('frontend', 'Is Common'),
        ];
    }

    public static function getCountry()
    {
        return self::find()->select('id,name,zh_name')->where(['is_common' => 1])->asArray()->all();
    }
}
