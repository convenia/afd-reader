<?php

namespace Convenia\AfdReader\Tests;

use Convenia\AfdReader\Field\Alphanumeric;
use PHPUnit_Framework_TestCase;

/**
 * Class AlphaNumericTest.
 */
class AlphaNumericTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new Alphanumeric();
        $val = $obj->format('  Remove begin and And spaces   ');
        $this->assertEquals('Remove begin and And spaces', $val);
    }
}
