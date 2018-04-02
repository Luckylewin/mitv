<?php
Yii::setAlias('@webroot', dirname(dirname(__DIR__)) . '/');
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@statics', dirname(dirname(__DIR__)) . '/statics');
Yii::setAlias('@css',  '/statics/css/');
Yii::setAlias('@js',  '/statics/js/');
Yii::setAlias('@components',  '/statics/js/');
Yii::setAlias('@uploads',  dirname(dirname(__DIR__)) . '/uploads');
