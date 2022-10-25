<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\RegistryNotExistsException;
use Convenia\AfdReader\Field\RegistryType;
use PHPUnit\Framework\TestCase;

class RegistryTypeTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new RegistryType();
        $val = $obj->format('O');
        $this->assertEquals('Original', $val);

        $val = $obj->format('I');
        $this->assertEquals('Incluído por digitação', $val);

        $val = $obj->format('P');
        $this->assertEquals('Pré-assinalado', $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongFormat()
    {
        $this->expectException(RegistryNotExistsException::class);
        $this->expectExceptionMessage('Value must be one of "O,I,P"');

        $obj = new RegistryType();
        $obj->format('HH');
    }
}
