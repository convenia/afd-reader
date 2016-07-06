<?php
namespace Convenia\AfdReader\Tests;

use PHPUnit_Framework_TestCase;
use Convenia\AfdReader\Field\RegistryType;
use \DateTime;

/**
 * Class AleloOrderTest.
 */
class RegistryTypeTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new RegistryType();
        $val = $obj->format('O');
        $this->assertEquals("Original", $val);
    }

    public function test_fail_value()
    {
        $this->setExpectedException('Convenia\AfdReader\Exception\RegistryNotExistsException');
        $obj = new RegistryType();
        $obj->format('HH');
    }
}
