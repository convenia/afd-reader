<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidDateFormatException;
use Convenia\AfdReader\Field\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new Date();
        $val = $obj->format('13061988');
        $this->assertInstanceOf('DateTime', $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongFormat()
    {
        $this->expectException(InvalidDateFormatException::class);
        $this->expectExceptionMessage('Value must be a valid date in the format dmY');

        $obj = new Date();
        $obj->format('225');
    }
}
