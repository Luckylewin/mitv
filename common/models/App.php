<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_app".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $introduce
 * @property string $short_introduce
 * @property string $month_price
 * @property string $season_price
 * @property string $half_price
 * @property string $year_price
 * @property string $free_day
 * @property string $imgae
 * @property string $faq
 */
class App extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_app';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_introduce',  'introduce', 'month_price', 'season_price', 'half_price', 'year_price', 'imgae'], 'required'],
            [['introduce','faq'], 'string'],
            [['month_price', 'season_price', 'half_price', 'year_price'], 'number'],
            [['name', 'url', 'imgae'], 'string', 'max' => 255],
            [['free_day'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'url' => Yii::t('app', 'Url'),
            'short_introduce' => Yii::t('app', '列表介绍'),
            'introduce' => Yii::t('app', '介绍'),
            'month_price' => Yii::t('app', '一个月价格'),
            'season_price' => Yii::t('app', '三个月价格'),
            'half_price' => Yii::t('app', '半年价格'),
            'year_price' => Yii::t('app', '年价'),
            'free_day' => Yii::t('app', '免费使用天数'),
            'imgae' => Yii::t('app', '图片'),
            'faq' => Yii::t('app', 'FAQ'),
        ];
    }

    public static function getApp()
    {
        return self::find()->all();
    }
}
