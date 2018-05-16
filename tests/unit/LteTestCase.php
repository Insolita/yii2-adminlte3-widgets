<?php

namespace tests\unit;

use function preg_replace;
use PHPUnit\Framework\TestCase;

class LteTestCase extends TestCase
{
    protected function inline($str):string
    {
        return str_replace(["\r\n", "\n", "> <"], ["", "", "><"], preg_replace('/\s{2,}/', ' ', $str));
    }
}
