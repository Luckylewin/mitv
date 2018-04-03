<?php
namespace common\models;

use yii\base\Model;

/**
 * Upload Form
 */
class UploadForm extends Model
{
   public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload'],'file','skipOnEmpty' => false,'checkExtensionByMimeType' => false,'extensions' => 'image/png,jpg,png,jpeg']
        ];
    }

}
