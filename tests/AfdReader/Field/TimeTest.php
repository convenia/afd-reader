<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidTimeFormatException;
use Convenia\AfdReader\Field\Time;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new Time();
        $val = $obj->format('2254');
        $this->assertEquals(['hour' => '22', 'minute' => '54'], $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongSize()
    {
        $this->expectException(InvalidTimeFormatException::class);
        $this->expectExceptionMessage('Value must be on the hhmm format.');

        $obj = new Time();
        $obj->format('225');
    }

    public function testItThrowsExceptionWhenValueIsNotANumber()
    {
        $this->expectException(InvalidTimeFormatException::class);
        $this->expectExceptionMessage('Value must be on the hhmm format.');

        $obj = new Time();
        $obj->format('aa11');
    }

    public function testItThrowsExceptionWhenMinutesAreGreaterThan60()
    {
        $this->expectException(InvalidTimeFormatException::class);
        $this->expectExceptionMessage('Value must be on the hhmm format.');

        $obj = new Time();
        $obj->format('1199');
    }
}
