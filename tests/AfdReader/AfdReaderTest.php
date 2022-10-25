<?php

namespace Tests\AfdReader;

use Convenia\AfdReader\AfdReader;
use Convenia\AfdReader\Exception\InvalidFileTypeException;
use PHPUnit\Framework\TestCase;

class AfdReaderTest extends TestCase
{
    public function testItShouldReadTheEntireFileIfOffsetAndChunkAreNotSpecified()
    {
        $afdReader = new AfdReader(__DIR__ . '/../files/afd_test.txt', AfdReader::AFD);

        $expected = [
            'header' => [
                'sequency' => '000000000',
                'type' => 1,
                'identityType' => 'CNPJ',
                'identityNumber' => '17484689000170',
                'cei' => '000000000000',
                'name' => 'Devs Nerds',
                'SerialNumber' => '00000000000000001',
                'registryStartDate' => '01012016',
                'registryEndDate' => '13042016',
                'generationDate' => '13042016',
                'generationTime' => ['hour' => 11, 'minute' => 37],
            ],
            'companyChange' => [[
                'nsr' => 1,
                'type' => 2,
                'date' => '01012016',
                'time' => ['hour' => 9, 'minute' => 0],
                'identityType' => '1',
                'identityNumber' => '17484689000170',
                'cei' => '000000000000',
                'name' => 'Devs Nerds',
                'place' => '',
            ]],
            'markAdjust' => [[
                'nsr' => 4,
                'type' => '4',
                'dateBefore' => '01012016',
                'timeBefore' => ['hour' => 9, 'minute' => 1],
                'dateAfter' => '01012016',
                'timeAfter' => ['hour' => 9, 'minute' => 0],
            ]],
            'employee' => [[
                'nsr' => 5,
                'type' => '5',
                'date' => '01012016',
                'time' => ['hour' => 12, 'minute' => 15],
                'operation' => 'Inclusão',
                'identityNumber' => '222222222222',
                'name' => 'Jose Joao',
            ]],
            'mark' => [
                '222222222222' => [
                    '01012016' => [
                        1 => [
                            [
                                'sequency' => 2,
                                'dateTime' => \DateTime::createFromFormat('Ymd Hi', '20160101 0901'),
                                'direction' => 'Entrada',
                            ], [
                                'sequency' => 3,
                                'dateTime' => \DateTime::createFromFormat('Ymd Hi', '20160101 1800'),
                                'direction' => 'Saída',
                            ]
                        ]
                    ]
                ]
            ],
            'trailer' => [
                'sequency' => '999999999',
                'numberType2' => 1,
                'numberType3' => 2,
                'numberType4' => 1,
                'numberType5' => 1,
                'type' => 9,
            ],
        ];

        $this->assertEquals($expected, $afdReader->getAll());
    }

    public function testItShouldReadFileFromOffset()
    {
        $afdReader = new AfdReader(__DIR__ . '/../files/afd_test.txt', AfdReader::AFD, 6);

        $expected = [
            'trailer' => [
                'sequency' => '999999999',
                'numberType2' => 1,
                'numberType3' => 2,
                'numberType4' => 1,
                'numberType5' => 1,
                'type' => 9,
            ],
            'mark' => []
        ];

        $this->assertEquals($expected, $afdReader->getAll());
    }

    public function testItShouldReadOnlyTheChunkSize()
    {
        $afdReader = new AfdReader(__DIR__ . '/../files/afd_test.txt', AfdReader::AFD, 0, 1);

        $expected = [
            'header' => [
                'sequency' => '000000000',
                'type' => 1,
                'identityType' => 'CNPJ',
                'identityNumber' => '17484689000170',
                'cei' => '000000000000',
                'name' => 'Devs Nerds',
                'SerialNumber' => '00000000000000001',
                'registryStartDate' => '01012016',
                'registryEndDate' => '13042016',
                'generationDate' => '13042016',
                'generationTime' => ['hour' => 11, 'minute' => 37],
            ],
            'mark' => []
        ];

        $this->assertEquals($expected, $afdReader->getAll());
    }

    public function testItShouldThrowExceptionWhenTheFileTypeIsInvalid()
    {
        $this->expectException(InvalidFileTypeException::class);
        $this->expectExceptionMessage('File type must be one of Afd, Afdt, Acjef');

        new AfdReader(__DIR__ . '/../files/afd_test.txt', 'test');
    }
}
