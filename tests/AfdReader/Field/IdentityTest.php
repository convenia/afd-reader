<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\IdentityNotExistsException;
use Convenia\AfdReader\Field\IdentityType;
use PHPUnit\Framework\TestCase;

class IdentityTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new IdentityType();
        $val = $obj->format('1');
        $this->assertEquals('CNPJ', $val);

        $val = $obj->format('2');
        $this->assertEquals('CPF', $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongFormat()
    {
        $this->expectException(IdentityNotExistsException::class);
        $this->expectExceptionMessage('Value must be one of "1,2"');

        $obj = new IdentityType();
        $obj->format('HH');
    }
}
