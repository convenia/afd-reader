<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\OvertimeModalityNotExistsException;
use Convenia\AfdReader\Field\OvertimeModality;
use PHPUnit\Framework\TestCase;

class OvertimeModalityTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new OvertimeModality();
        $val = $obj->format('D');
        $this->assertEquals('Diurno', $val);

        $val = $obj->format('N');
        $this->assertEquals('Noturno', $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongFormat()
    {
        $this->expectException(OvertimeModalityNotExistsException::class);
        $this->expectExceptionMessage('Value must be one of "D,N"');

        $obj = new OvertimeModality();
        $obj->format('HH');
    }
}
