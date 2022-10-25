<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Exception\OperationTypeNotExistsException;
use Convenia\AfdReader\Field\OperationType;
use PHPUnit\Framework\TestCase;

class OperationTypeTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new OperationType();
        $val = $obj->format('I');
        $this->assertEquals('Inclusão', $val);

        $val = $obj->format('A');
        $this->assertEquals('Alteração', $val);

        $val = $obj->format('E');
        $this->assertEquals('Exclusão', $val);
    }

    public function testItThrowsExceptionWhenValueHasWrongFormat()
    {
        $this->expectException(OperationTypeNotExistsException::class);
        $this->expectExceptionMessage('Value must be one of "I,A,E"');

        $obj = new OperationType();
        $obj->format('HH');
    }
}
