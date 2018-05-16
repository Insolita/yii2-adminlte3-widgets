<?php
define('YII_ENV', 'test');
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
Yii::setAlias('@vendor', __DIR__.'/../vendor');
Yii::setAlias('@bower', '@vendor/bower-asset');
Yii::setAlias('@npm', '@vendor/npm-asset');
require __DIR__ .'/../vendor/autoload.php';