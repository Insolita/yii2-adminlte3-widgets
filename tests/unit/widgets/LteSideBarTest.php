<?php

namespace tests\unit\widgets;

use function expect;
use insolita\adminlte3\LteSideBar;
use tests\unit\app\TestController;
use tests\unit\LteTestCase;
use yii\helpers\Html;

class LteSideBarTest extends LteTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mockApplication();
        $controller = new TestController('test-controller', \Yii::$app);
        \Yii::$app->controller = $controller;
    }
    
    public function testSidebarWidget()
    {
        $config = $this->widgetConfig();
        $config['route'] = 'foo/bar';
        $widget = LteSideBar::widget($config);
        expect($this->inline($widget))->contains('<div class="user-panel mt-3 pb-3 mb-3 d-flex">');
        expect($this->inline($widget))->contains('class="brand-link">');
        expect($this->inline($widget))->contains('nav nav-pills nav-sidebar flex-column');
        expect($this->inline($widget))->contains('nav nav-treeview');
        expect($this->inline($widget))->contains(Html::tag('span', 23, ['class' => 'right badge bg-info']));
        expect($this->inline($widget))->notContains('<a class="nav-link active"');
        expect($this->inline($widget))->notContains('menu-open');
    }
    
    public function testSingleItemActivation()
    {
        $config = $this->widgetConfig();
        $config['route'] = 'test/two';
        $widget = LteSideBar::widget($config);
        expect($this->inline($widget))->contains('<a class="nav-link active" href="/index.php?r=test/two">');
        expect($this->inline($widget))->notContains('menu-open');
    }
    
    public function testChildItemActivation()
    {
        $config = $this->widgetConfig();
        $config['route'] = 'test/lte';
        $widget = LteSideBar::widget($config);
        expect($this->inline($widget))->contains('<a class="nav-link active" href="/index.php?r=test/lte">');
        expect($this->inline($widget))->contains('<li class="has-treeview nav-item menu-open">');
    }
    
    protected function widgetConfig()
    {
        return [
            'params' => [],
            'userEnabled' => true,
            'brandEnabled' => true,
            'brand' => [
                'text' => 'Brand',
                'image' => '/img/1.png',
                'link' => '#',
            ],
            'user' => [
                'text' => 'User Name',
                'image' => '/img/2.png',
                'link' => '#',
            ],
            'items' => [
                ['label' => 'One', 'url' => ['test/one'], 'icon' => 'fa fa-bullhorn'],
                ['label' => 'Two', 'url' => ['test/two'], 'icon' => 'fa fa-beer'],
                [
                    'label' => 'SubMenu1',
                    'icon' => 'fa fa-download',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Main', 'url' => ['test/index'], 'icon' => 'fa fa-home'],
                        ['label' => 'Lte', 'url' => ['test/lte'], 'icon' => 'fa fa-bullseye'],
                    ],
                ],
                [
                    'label' => 'Three',
                    'url' => 'pages/three',
                    'icon' => 'fa fa-gavel',
                    'badge' => Html::tag('span', 23, ['class' => 'right badge bg-info']),
                ],
            ],
        ];
    }
}

