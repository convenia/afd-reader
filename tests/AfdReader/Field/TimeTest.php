<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidTimeFormatException;
use Convenia\AfdReader\Field\Time;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $class = new Time();
        $value = $class->format('2254');
        $this->assertEquals(['hour' => '22', 'minute' => '54'], $value);
    }

    public function testItThrowsExceptionWhenValueHasWrongSize()
    {
        $this->expectException(InvalidTimeFormatException::class);
        $this->expectExceptionMessage('Value must be on the hhmm format.');

        $class = new Time();
        $class->format('225');
    }

    public function testItThrowsExceptionWhenValueIsNotANumber()
    {
        $this->expectException(InvalidTimeFormatException::class);
        $this->expectExceptionMessage('Value must be on the hhmm format.');

        $class = new Time();
        $class->format('aa11');
    }

    public function testItThrowsExceptionWhenMinutesAreGreaterThan60()
    {
        $this->expectException(InvalidTimeFormatException::class);
        $this->expectExceptionMessage('Value must be on the hhmm format.');

        $class = new Time();
        $class->format('1199');
    }

    public function testItReturnsZeroWhenValueIsFilledWithWhiteSpaces()
    {
        $class = new Time();
        $value = $class->format('    ');
        $this->assertEquals(['hour' => '00', 'minute' => '00'], $value);
    }
}
