<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/4/2
 * Time: 14:31
 */

namespace backend\controllers;

use common\models\UploadForm;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;


class ImageController extends Controller
{

    public function actionUpload()
    {
        $this->layout = false;

        if (Yii::$app->request->isPost) {

            $fileUploader = UploadedFile::getInstanceByName('upload');
            $newName = Yii::getAlias('@statics') . "/images/". $fileUploader->name;
            $fileUploader->saveAs($newName);

            if ($fileUploader->error == 0 ) {
                $data['uploaded'] = 1;
                $data['fileName'] = $fileUploader->name;
                $data['url'] = '/statics/images/' . $fileUploader->name;

            } else {
                $data['uploaded'] = 0;
                $data['error'] = $fileUploader->error;
            }

            header('Content-Type:application/json;charset=utf-8');

            exit(json_encode($data));
        }

    }
}