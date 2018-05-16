<?php

namespace tests\unit\widgets;

use function expect;
use insolita\adminlte3\LteBreadcrumbs;
use tests\unit\LteTestCase;
use yii\helpers\VarDumper;

class LteBreadCrumbsTest extends LteTestCase
{
    public function testBreadCrumbWidget()
    {
        $widget = LteBreadcrumbs::widget([
            'homeLink' => ['label' => 'Home', 'url' => '/'],
            'links' => [
                ['label' => 'Bar', 'url' => 'foo'],
                ['label' => 'Foo'],
            ],
        ]);
        VarDumper::dump($widget);
        expect($widget)->startsWith('<nav');
        expect($widget)->contains('<li class="breadcrumb-item"><a href="/">Home</a></li>');
        expect($widget)->contains('<li class="breadcrumb-item"><a href="foo">Bar</a></li>');
        expect($widget)->contains('<li class="breadcrumb-item active">Foo</li>');
        
        expect($widget)->endsWith('</nav>');
    }
}
