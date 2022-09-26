<?php

namespace Tests\AfdReader\Field;

use Convenia\AfdReader\Field\Alphanumeric;
use PHPUnit\Framework\TestCase;

class AlphaNumericTest extends TestCase
{
    public function testItCorrectlyFormatsAValue()
    {
        $obj = new Alphanumeric();
        $val = $obj->format('  Remove begin and end spaces   ');
        $this->assertEquals('Remove begin and end spaces', $val);
    }
}
