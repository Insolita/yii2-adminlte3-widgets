<?php

namespace tests\unit\widgets;

use insolita\adminlte3\LteAlert;
use tests\unit\LteTestCase;
use function expect;

class LteAlertTest extends LteTestCase
{
    public function testAlertWidgetSimple()
    {
        $widget = LteAlert::widget([
            'id' => 'alert1',
            'closable' => false,
            'text' => 'Foo bar baz message',
            'icon' => 'fa fa-shopping-cart',
        ]);
        $expect = '<div id="alert1" class="alert alert-success"><i class="icon fa fa-shopping-cart"></i>'
            . ' Foo bar baz message</div>';
        expect($this->inline($widget))->equals($this->inline($expect));
    }
    
    public function testAlertWidgetClosable()
    {
        $widget = LteAlert::widget([
            'closable' => true,
            'text' => 'Foo bar baz message',
            'icon' => 'fa fa-shopping-cart',
        ]);
        $expect='<div id="w0" class="alert alert-success alert-dismissable">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            . '<i class="icon fa fa-shopping-cart"></i> Foo bar baz message</div>';
        expect($this->inline($widget))->equals($this->inline($expect));
    }
    
    public function testAlertWidgetWithTitle()
    {
        $widget = LteAlert::widget([
            'id' => 'alert2',
            'closable' => true,
            'text' => 'Foo bar baz message',
            'title'=> 'Alert Head!',
            'icon' => 'fa fa-shopping-cart',
        ]);
        $expect='<div id="alert2" class="alert alert-success alert-dismissable">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            . '<h5><i class="icon fa fa-shopping-cart"></i> Alert Head!</h5>'
            . 'Foo bar baz message</div>';
        expect($this->inline($widget))->equals($this->inline($expect));
    }
}
