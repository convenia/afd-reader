<?php
namespace Convenia\AfdReader\Tests;

use PHPUnit_Framework_TestCase;
use Convenia\AfdReader\Field\Alphanumeric;

/**
 * Class AleloOrderTest.
 */
class AlphanumericTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new Alphanumeric();
        $val = $obj->format('  Remove begin and And spaces   ');
        $this->assertEquals('Remove begin and And spaces', $val);
    }
}
