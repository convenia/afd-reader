<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\DirectionNotExistsException;
use Convenia\AfdReader\Field\Direction;
use PHPUnit\Framework\TestCase;

class DirectionTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new Direction();
        $val = $obj->format('E');
        $this->assertEquals('Entrada', $val);

        $val = $obj->format('S');
        $this->assertEquals('Saída', $val);

        $val = $obj->format('D');
        $this->assertEquals('Desconsiderado', $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongFormat()
    {
        $this->expectException(DirectionNotExistsException::class);
        $this->expectExceptionMessage('Value must be one of "E,S,D"');

        $obj = new Direction();
        $obj->format('HH');
    }
}
