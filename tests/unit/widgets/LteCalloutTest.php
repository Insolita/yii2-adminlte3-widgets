<?php

namespace tests\unit\widgets;

use insolita\adminlte3\Lte;
use insolita\adminlte3\LteCallout;
use tests\unit\LteTestCase;
use function expect;

class LteCalloutTest extends LteTestCase
{
    public function testCalloutWidget()
    {
        $widget = LteCallout::widget([
            'id'=>'callout1',
            'text' => 'Some content',
            'type' => Lte::TYPE_SUCCESS,
            'title' => 'Some title'
        ]);
        $expect = <<<HTML
<div id="callout1" class="callout callout-success">\n
<h5>Some title</h5>Some content</div>
HTML;
        expect($this->inline($widget))->equals($this->inline($expect));
    }
}
