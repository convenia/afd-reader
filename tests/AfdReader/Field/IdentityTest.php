<?php

namespace Convenia\AfdReader\Tests;

use Convenia\AfdReader\Field\IdentityType;
use PHPUnit_Framework_TestCase;

/**
 * Class IdentityTest.
 */
class IdentityTest extends PHPUnit_Framework_TestCase
{
    public function test_success_value()
    {
        $obj = new IdentityType();
        $val = $obj->format('1');
        $this->assertEquals('CNPJ', $val);
    }

    public function test_fail_value()
    {
        $this->setExpectedException('Convenia\AfdReader\Exception\IdentityNotExistsException');
        $obj = new IdentityType();
        $obj->format('HH');
    }
}
