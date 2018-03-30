<?php
namespace common\models;

use yii\base\Model;

/**
 * Upload Form
 */
class UploadForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'],'file','skipOnEmpty' => false,'checkExtensionByMimeType' => false,'extensions' => 'html,xls,xlsx']
        ];
    }

}
