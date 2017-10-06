<?php

namespace Convenia\AfdReader\Tests;

use Convenia\AfdReader\AfdReader;
use PHPUnit_Framework_TestCase;

/**
 * Class AfdReaderTest.
 */
class AfdReaderTest extends PHPUnit_Framework_TestCase
{
    public function test_afdt_file()
    {
        $return = new AfdReader('tests/afdt_test.txt');
        $val = $return->getByUser();
        $this->assertArrayHasKey('016428553393', $val);
    }

    public function test_afd_file()
    {
        $return = new AfdReader('tests/afd_test.txt');
        $val = $return->getByUser();
        $this->assertArrayHasKey('016838599008', $val);
    }

    public function test_acjef_file()
    {
        $return = new AfdReader('tests/acjef_1_test.txt');
        $val = $return->getByUser();
        $this->assertArrayHasKey('012279542414', $val);
    }
}
