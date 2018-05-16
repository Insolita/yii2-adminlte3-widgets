<?php

namespace tests\unit\app;

use yii\web\Controller;

class TestController extends Controller
{
    public function actionOne()
    {
        return 'test1';
    }
    public function actionTwo()
    {
        return 'test2';
    }
    public function actionIndex()
    {
        return 'index';
    }
    public function actionLte()
    {
        return 'lte';
    }
}