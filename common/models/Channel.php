<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_channel".
 *
 * @property integer $id
 * @property integer $sort
 * @property integer $pid
 * @property string $name
 * @property string $image
 * @property integer $area_id
 */
class Channel extends \yii\db\ActiveRecord
{

    public $app_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'name'], 'required'],
            [['sort', 'pid', 'area_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['app_id'], 'safe'],
            [['sort'],'default', 'value' => 0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'sort' => Yii::t('frontend', '排序'),
            'pid' => Yii::t('frontend', '父id'),
            'name' => Yii::t('frontend', '名称'),
            'image' => Yii::t('frontend', '图标'),
            'area_id' => Yii::t('frontend', '地区'),
        ];
    }

    /**
     * 多对多关联
     * @return \yii\db\ActiveQuery
     */
    public function getApps()
    {
        return $this->hasMany(AppToChannel::className(),['channel_id' => 'id'])->joinWith('app');
    }

    public static function getClass($area_id = null)
    {
        if ($area_id) {
            $where = ['area_id' => $area_id];
        } else {
            $where = true;
        }
        $class = self::find()->where($where)->select('id,name,pid')->asArray()->all();
        $class = self::getDropDownList($class);

        return array_merge([['id'=>0,'name'=>'一级分类']] , $class);
    }

    public static function getIntroduceList($data)
    {
        $class = self::find()->select('id,name,pid')->asArray()->all();
        $items = [];
        foreach ($data as $value) {
           $items[] = self::getIntroduce($class, $value);
        }

        return $items;
    }

    public static function getIntroduce($data, $pid = 0)
    {
        $items = [];

        foreach ($data as $value) {
            if ($value['id'] == $pid) {
                $items = $value;
                break;
            }
        }

        $items['child'] = self::getTree($data, $pid);
        return $items;
    }

    public static function getDropDownList($data, $pid = 0, $deliver='|-', $spilter = '   ---')
    {
        $items = [];

        foreach ($data as $value) {
            if ($value['id'] == $pid) {
                $items[] = $value;
                break;
            }
        }

        $data = self::getTree($data, $pid);
        foreach ($data as $key => $value) {
            $value['name'] = $deliver . $value['name'];
            $childes = null;
            if (!empty($value['child'])) {
               $childes = $value['child'];
               unset($value['child']);
            }
            $items[] = $value;
            if ($childes) {
                foreach ($childes as $child) {
                    $child['name'] =  $spilter . $child['name'];
                    $items[] = $child;
                }
            }
        }

        return $items;
    }

    public static function getTree($data, $pid = 0)
    {
        $items = [];
        foreach ($data as $value) {
                //找到子类
            if ($value['pid'] == $pid) {
                $value['child'] = self::getTree($data, $value['id']);
                $items[] = $value;
            }
        }

        return $items;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->pid == 0) {
                self::deleteAll(['pid' => $this->id]);
            }
            AppToChannel::deleteAll(['channel_id' => $this->id]);
        }

        return true;
    }

}
