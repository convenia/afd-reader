<?php

namespace Convenia\AfdReader\Tests;

use Convenia\AfdReader\AfdReader;
use PHPUnit_Framework_TestCase;

/**
 * Class AfdReaderTest.
 */
class AfdReaderTest extends PHPUnit_Framework_TestCase
{
    public function test_read_file()
    {
        $return = new AfdReader('tests/afdt_test.txt');
        $val = $return->getByUser();
        $this->assertArrayHasKey('016428553393', $val);
    }

    public function test_magic_file()
    {
        $return = new AfdReader('tests/afd_test.txt');
        $val = $return->getByUser();
        $this->assertArrayHasKey('016838599008', $val);
    }
}
