<?php
namespace Convenia\AfdReader\Tests;

use \Convenia\AfdReader\Exception\InvalidDateFormat;
use PHPUnit_Framework_TestCase;
use Convenia\AfdReader\Field\Date;
use \DateTime;

/**
 * Class AleloOrderTest.
 */
class DateTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new Date();
        $val = $obj->format('13061988');
        $this->assertInstanceOf("DateTime", $val);
    }
}
