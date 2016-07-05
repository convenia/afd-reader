<?php
namespace Convenia\AfdReader\Tests;

use PHPUnit_Framework_TestCase;
use Convenia\AfdReader\AfdReader;
use Convenia\AfdReader\Exception\FileNotFoundException;

/**
 * Class AleloOrderTest.
 */
class AfdReaderTest extends PHPUnit_Framework_TestCase
{
    public function test_read_file()
    {
        //$return = new AfdReader('../../../uploads/afdt_test.txt', 'Afdt');
        $return = new AfdReader('afdt_test.txt');
        $val = $return->getByUser();
        $this->assertArrayHasKey('016428553393', $val);
    }

    public function test_magic_file()
    {
        //$return = new AfdReader('../../../uploads/afdt_test.txt', 'Afdt');
        $return = new AfdReader('afd_test.txt');
        $val = $return->getByUser();
        $this->assertArrayHasKey('016838599008', $val);
    }
}
