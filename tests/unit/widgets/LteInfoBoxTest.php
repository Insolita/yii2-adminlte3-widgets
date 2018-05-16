<?php

namespace tests\unit\widgets;

use insolita\adminlte3\Lte;
use insolita\adminlte3\LteInfoBox;
use tests\unit\LteTestCase;
use function expect;

class LteInfoBoxTest extends LteTestCase
{
    public function testInfoBoxWidgetDefault()
    {
        $widget = LteInfoBox::widget(['text' => 'Foo', 'number' => 77]);
        $expect = '<div class="info-box bg-light">'
            . '<span class="info-box-icon bg-primary"><i class="fa fa-bullhorn"></i></span>'
            . '<div class="info-box-content"><span class="info-box-text">Foo</span>'
            . '<span class="info-box-number">77</span></div></div>';
        expect($this->inline($widget))->equals($this->inline($expect));
    }
    
    public function testInfoBoxWidgetWithProgress()
    {
        $widget = LteInfoBox::widget([
            'bgIconColor' => '',
            'bgColor' => Lte::GRADIENT_INFO,
            'text' => 'Foo',
            'number' => 77,
            'progressNumber' => 34,
            'showProgress' => true,
            'description' => 'percentage',
        ]);
        $expect
            = <<<HTML
<div class="info-box bg-info-gradient">
      <span class="info-box-icon"><i class="fa fa-bullhorn"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Foo</span>
        <span class="info-box-number">77</span>
        <div class="progress"><div class="progress-bar" style="width:34%"></div></div>\n<span
        class="progress-description">percentage</span>
      </div>
</div>
HTML;
        expect($this->inline($widget))->equals($this->inline($expect));
    }
}
