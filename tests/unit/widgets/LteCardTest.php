<?php

namespace tests\unit\widgets;

use insolita\adminlte3\Lte;
use insolita\adminlte3\LteCard;
use tests\unit\LteTestCase;
use function expect;

class LteCardTest extends LteTestCase
{
    public function testCardWidget()
    {
        $widget = LteCard::widget([
            'id' => 'card1',
            'type' => Lte::TYPE_INFO,
            'title' => 'The Title',
            'body' => 'The Body',
            'footer' => 'The Footer',
        ]);
        $expected = '<div id="card1" class="card card-info card-outline">'
            . '<div class="card-header"><h3 class="card-title">The Title</h3></div>'
            . '<div class="card-body"> The Body </div>'
            . '<div class="card-footer">The Footer</div>'
            . '</div>';
        expect($this->inline($widget))->equals($this->inline($expected));
    }
    
    public function testCardWidgetNotOutlined()
    {
        $widget = LteCard::widget([
            'id' => 'card1',
            'isOutlined' => false,
            'type' => Lte::TYPE_INFO,
            'title' => 'The Title',
            'body' => 'The Body',
            'footer' => 'The Footer',
        ]);
        expect($this->inline($widget))->notContains('card-outline');
        expect($this->inline($widget))->contains('card-info');
    }
    public function testCardWidgetSolidBg()
    {
        $widget = LteCard::widget([
            'id' => 'card1',
            'isSolidBg' => true,
            'type' => Lte::TYPE_INFO,
            'title' => 'The Title',
            'body' => 'The Body',
            'footer' => 'The Footer',
        ]);
        expect($this->inline($widget))->contains('bg-info');
        expect($this->inline($widget))->notContains('card-info');
    }
    
    public function testCardWidgetWithCustomTools()
    {
        $widget = LteCard::widget([
            'id' => 'card1',
            'type' => Lte::TYPE_INFO,
            'title' => 'The Title',
            'body' => 'The Body',
            'tools' => '<button class="btn btn-sm">My Button</button>',
        ]);
        $expected = '<div class="card-header"><h3 class="card-title">The Title</h3>'
            . '<div class="card-tools"><button class="btn btn-sm">My Button</button></div></div>';
        expect($this->inline($widget))->contains($expected);
        expect($this->inline($widget))->notContains('card-footer');
    }
    
    public function testCardWidgetWithInternalTools()
    {
        $widget = LteCard::widget([
            'id' => 'card1',
            'type' => Lte::TYPE_INFO,
            'title' => 'The Title',
            'body' => 'The Body',
            'removeEnabled' => true,
            'collapseEnabled' => true,
            'refreshEnabled' => true,
        ]);
        $expected = '<div class="card-header"><h3 class="card-title">The Title</h3><div class="card-tools">';
        $expected .= '<button type="button" id="card1_collapse" class="btn btn-tool" data-widget="collapse">'
            . '<i class="fa fa-minus"></i></button>';
        $expected .= '<button type="button" id="card1_refresh" class="btn btn-tool" data-widget="refresh">'
            . '<i class="fa fa-refresh"></i></button>';
        $expected .= '<button type="button" id="card1_remove" class="btn btn-tool" data-widget="remove">'
            . '<i class="fa fa-times"></i></button>'
            . '</div>';
        expect($this->inline($widget))->contains($this->inline($expected));
    }
}
