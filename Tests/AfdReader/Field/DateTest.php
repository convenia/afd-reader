<?php

namespace Convenia\AfdReader\Tests;

use Convenia\AfdReader\Field\Date;
use DateTime;
use PHPUnit_Framework_TestCase;

/**
 * Class AleloOrderTest.
 */
class DateTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new Date();
        $val = $obj->format('13061988');
        $this->assertInstanceOf('DateTime', $val);
    }
}
