<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidOvertimePercentageException;
use Convenia\AfdReader\Field\OvertimePercentage;
use PHPUnit\Framework\TestCase;

class OvertimePercentageTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new OvertimePercentage();
        $val = $obj->format('2254');
        $this->assertEquals(['integer' => '22', 'decimal' => '54'], $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongSize()
    {
        $this->expectException(InvalidOvertimePercentageException::class);
        $this->expectExceptionMessage('Value must be a valid integer with exact 4 digits');

        $obj = new OvertimePercentage();
        $obj->format('225');
    }

    public function testItThrowsExceptionWhenValueIsNotANumber()
    {
        $this->expectException(InvalidOvertimePercentageException::class);
        $this->expectExceptionMessage('Value must be a valid integer and greater than zero');

        $obj = new OvertimePercentage();
        $obj->format('aa11');
    }

    public function testItThrowsExceptionWhenMinutesAreGreaterThan60()
    {
        $this->expectException(InvalidOvertimePercentageException::class);
        $this->expectExceptionMessage('Value must be a valid integer and greater than zero');

        $obj = new OvertimePercentage();
        $obj->format('-199');
    }
}
