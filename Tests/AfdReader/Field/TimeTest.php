<?php

namespace Convenia\AfdReader\Tests;

use Convenia\AfdReader\Field\Time;
use PHPUnit_Framework_TestCase;

/**
 * Class AleloOrderTest.
 */
class TimeTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new Time();
        $val = $obj->format('2254');
        $this->assertEquals(['hour' => '22', 'minute' => '54'], $val);
    }

    public function test_fail_value()
    {
        $this->setExpectedException('Convenia\AfdReader\Exception\InvalidTimeFormatException');
        $obj = new Time();
        $obj->format('225');
    }
}
