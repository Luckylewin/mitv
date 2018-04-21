<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sys_order".
 *
 * @property integer $id
 * @property string $mac
 * @property string $name
 * @property string $active_time
 * @property string $expire_time
 * @property integer $type
 * @property string $total
 * @property string $app_name
 * @property string $invoice_number
 * @property string $is_pay
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends \yii\db\ActiveRecord
{

    const CHARGE = 1;
    const FREE = 0;

    public static $payStatus = ['未支付','已支付'];
    public static $payPeriod = [
                            0=>'试用',
                            1=>'一个月',
                            3=>'三个月',
                            6=>'六个月',
                            12=>'一年'
    ];

    public $app;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ],
                'value' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mac','type'], 'required'],
            [['active_time', 'expire_time','app','type','created_time','updated_time','is_pay'], 'safe'],
            [['type'], 'string'],
            [['total'], 'number'],
            [['mac'], 'string', 'max' => 64],
            [['name', 'app_name'], 'string', 'max' => 255],
            [['invoice_number'], 'string', 'max' => 20],
            //[['repassword'], 'compare', 'compareAttribute' => 'password', 'message' => 'retype password must be consistent with pass']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'mac' => Yii::t('frontend', 'Mac'),
            'name' => Yii::t('frontend', 'Name'),

            'active_time' => Yii::t('frontend', '激活时间'),
            'expire_time' => Yii::t('frontend', '过期时间'),
            'type' => Yii::t('frontend', '类型'),
            'total' => Yii::t('frontend', '金额'),
            'app_name' => Yii::t('frontend', 'APK名称'),
            'invoice_number' => Yii::t('frontend', '商户订单号'),
            'is_pay' => Yii::t('frontend', '是否已经支付'),
            'created_at' => '创建时间',
            'updated_at' => '更新时间'
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $types = [1=>'month_price', 3=>'season_price',6=>'half_price',12=>'year_price'];
                $app = App::findOne(['id' => $this->app]);
                if (isset($types[$this->type]) && $app) {
                    $field = $types[$this->type];
                    $this->total = $app->$field;
                    $this->app_name = $app->name;
                    $this->invoice_number = $this->generateOrder();
                } else{
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 产生订单号
     * @return string
     */
    public function generateOrder()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        return $orderSn = $yCode[intval(date('Y')) - 2018] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    }
    
    public static function getPayStatus()
    {
       return self::$payStatus;
    }

    public function getPayStatusLabel()
    {
        $status = self::$payStatus[$this->is_pay];
        $color = $this->is_pay ? 'success' : 'default';
        return "<span class='label label-$color'>" . $status. "</span>";
    }



    public function getTypeStatus()
    { 
       $type = self::$payPeriod;
       return $type[$this->type];	
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['username' => 'mac']);
    }

}
