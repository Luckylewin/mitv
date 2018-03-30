<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_user".
 *
 * @property integer $id
 * @property string $mac
 * @property string $name
 * @property string $password
 * @property string $active_time
 * @property string $expire_time
 */
class SysUser extends \yii\db\ActiveRecord
{
    public $repassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mac', 'name', 'password', 'repassword'], 'required'],
            [['id'], 'integer'],
            [['active_time', 'expire_time'], 'safe'],
            [['mac'], 'string', 'max' => 64],
            [['name', 'password'], 'string', 'max' => 255],
            [['repassword'], 'compare', 'compareAttribute' => 'password', 'message' => 'retype password must be consistent with pass']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mac' => Yii::t('apps', 'Mac'),
            'name' => Yii::t('app', 'Name'),
            'password' => Yii::t('app', 'Password'),
            'active_time' => Yii::t('app', '激活时间'),
            'expire_time' => Yii::t('app', '过期时间'),
        ];
    }

}
