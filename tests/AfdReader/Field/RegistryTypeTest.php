<?php

namespace Convenia\AfdReader\Tests;

use Convenia\AfdReader\Field\RegistryType;
use PHPUnit_Framework_TestCase;

/**
 * Class RegistryTypeTest.
 */
class RegistryTypeTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new RegistryType();
        $val = $obj->format('O');
        $this->assertEquals('Original', $val);
    }

    public function test_fail_value()
    {
        $this->setExpectedException('Convenia\AfdReader\Exception\RegistryNotExistsException');
        $obj = new RegistryType();
        $obj->format('HH');
    }
}
