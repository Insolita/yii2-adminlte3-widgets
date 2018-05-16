<?php

namespace tests\unit;

use function preg_replace;
use PHPUnit\Framework\TestCase;
use yii\web\Application;
use yii\web\View;

class LteTestCase extends TestCase
{
    protected function inline($str): string
    {
        return str_replace(["\r\n", "\n", "> <", "%2F"], ["", "", "><", "/"], preg_replace('/\s{2,}/', ' ', $str));
    }
    
    protected function mockApplication()
    {
        new Application([
            'id' => 'testapp',
            'basePath' => __DIR__ . '/../../',
            'vendorPath' => __DIR__ . '/../../vendor',
            'aliases' => [
                '@bower' => '@vendor/bower-asset',
                '@npm' => '@vendor/npm-asset',
            ],
            'components' => [
                'assetManager' => [
                    'basePath' => __DIR__ . '/app/runtime',
                ],
                'request' => [
                    'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
                    'scriptFile' => __DIR__ . '/index.php',
                    'scriptUrl' => '/index.php',
                ],
                'view' => [
                    'class' => View::class,
                ],
            ],
        ]);
    }
}
