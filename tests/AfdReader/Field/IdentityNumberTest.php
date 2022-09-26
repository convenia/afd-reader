<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidIdentityFormatException;
use Convenia\AfdReader\Field\IdentityNumber;
use PHPUnit\Framework\TestCase;

class IdentityNumberTest extends TestCase
{
    public function testItCorrectlyFormatsAVValue()
    {
        $obj = new IdentityNumber();
        $val = $obj->format('11');
        $this->assertEquals(11, $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongFormat()
    {
        $this->expectException(InvalidIdentityFormatException::class);
        $this->expectExceptionMessage('Value must be composed of only digits');

        $obj = new IdentityNumber();
        $obj->format('HH');
    }
}
