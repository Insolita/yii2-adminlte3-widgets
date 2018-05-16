<?php

namespace tests\unit\widgets;

use function expect;
use insolita\adminlte3\Lte;
use insolita\adminlte3\LteNavBar;
use tests\unit\app\TestController;
use tests\unit\LteTestCase;

class LteNavBarTest extends LteTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mockApplication();
        $controller = new TestController('test-controller', \Yii::$app);
        \Yii::$app->controller = $controller;
    }
    
    public function testNavbarWidget()
    {
        $config = $this->widgetConfig();
        $widget = LteNavbar::widget($config);
        $widget = $this->inline($widget);
        expect($widget)->contains('<form class="form-inline ml-3"');
        expect($widget)->contains('<a class="nav-link" data-widget="pushmenu"');
        expect($widget)->contains('<a class="nav-link" data-widget="control-sidebar"');
        expect($widget)->contains('<a class="nav-link" href="/index.php?r=site/left">LeftItem</a>');
        expect($widget)->contains('<a class="nav-link" href="/index.php?r=site/right">RightItem</a>');
        expect($widget)->contains('<li class="dropdown nav-item">');
        expect($widget)->contains('<div class="dropdown-header">Dropdown Header</div>');
    }
    
    public function testNavbarWidgetMinimal()
    {
        $config = $this->widgetConfig();
        $config['enableSearch'] = false;
        $config['toggleSidebar'] = false;
        $config['controlSidebar'] = false;
        $widget = LteNavbar::widget($config);
        $widget = $this->inline($widget);
        expect($widget)->notContains('<form class="form-inline ml-3"');
        expect($widget)->notContains('<a class="nav-link" data-widget="pushmenu"');
        expect($widget)->notContains('<a class="nav-link" data-widget="control-sidebar"');
        expect($widget)->contains('<a class="nav-link" href="/index.php?r=site/left">LeftItem</a>');
        expect($widget)->contains('<a class="nav-link" href="/index.php?r=site/right">RightItem</a>');
        expect($widget)->contains('<div class="dropdown-header">Dropdown Header</div>');
    }
    
    protected function widgetConfig()
    {
        return [
            'bgColor' => Lte::GRADIENT_SUCCESS,
            'isDark' => true,
            'enableSearch' => true,
            'toggleSidebar' => true,
            'controlSidebar' => true,
            'leftItems' => [
                ['label' => 'LeftItem', 'url' => ['site/left'], 'options' => ['class' => 'd-none d-sm-inline-block']],
            ],
            'rightItems' => [
                ['label' => 'RightItem', 'url' => ['site/right']],
                [
                    'label' => 'Dropdown',
                    'items' => [
                        ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                        '<div class="dropdown-divider"></div>',
                        '<div class="dropdown-header">Dropdown Header</div>',
                        ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
                    ],
                ],
            ],
        ];
    }
}
