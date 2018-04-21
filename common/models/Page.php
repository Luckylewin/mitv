<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_page".
 *
 * @property integer $id
 * @property string $tittle
 * @property string $content
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tittle', 'content'], 'required'],
            [['content'], 'string'],
            [['tittle'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tittle' => '标题',
            'content' => '内容',
        ];
    }
}
