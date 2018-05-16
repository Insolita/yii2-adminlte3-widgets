<?php

namespace tests\unit\widgets;

use insolita\adminlte3\LteSmallBox;
use tests\unit\LteTestCase;
use function expect;

class LteSmallBoxTest extends LteTestCase
{
    public function testSmallBoxWidget()
    {
        $widget = LteSmallBox::widget([
            'id'=>'box',
            'title' => 150,
            'text' => 'New Orders',
            'link' => '#',
            'footer' => 'More info',
            'icon' => 'fa fa-shopping-cart',
        ]);
        $expect = <<<HTML
<div id="box" class="small-box bg-info">\n
<div class="inner"><h3>150</h3><p>New Orders</p></div>\n
<div class="icon"><i class="fa fa-shopping-cart"></i></div>\n
<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
HTML;
        expect($this->inline($widget))->equals($this->inline($expect));
    }
}
