<?php

namespace Tests\AfdReader;

use Convenia\AfdReader\AfdReader;
use PHPUnit\Framework\TestCase;

class AcjefReaderTest extends TestCase
{
    public function testItGetsAllDataFromFile()
    {
        $return = new AfdReader(__DIR__ . '/../files/acjef_test.txt');
        $values = $return->getAll();

        $expected = [
            'header' => [
                'sequency' => '000000001',
                'type' => '1',
                'entityType' => 'CNPJ',
                'entityNumber' => '17484689000170',
                'cei' => '000000000000',
                'name' => 'Devs Nerds',
                'startDate' => '01012016',
                'endDate' => '13042016',
                'generationDate' => \DateTime::createFromFormat('Y-m-d', '2016-04-13'),
                'generationTime' => [
                    'hour' => '11',
                    'minute' => '37'
                ]
            ],
            'detail' => [
                '111111111111' => [
                    [
                        'sequency' => '000000001',
                        'type' => '3',
                        'startDate' => '01012021',
                        'firstHour' => ['hour' => '09', 'minute' => '00'],
                        'hourCode' => '0001',
                        'dayTime' => ['hour' => '08', 'minute' => '00'],
                        'nightTime' => ['hour' => '00', 'minute' => '00'],
                        'overtime1' => ['hour' => '01', 'minute' => '00'],
                        'overtimePercentage1' => ['integer' => '50', 'decimal' => '00'],
                        'overtimeModality1' => 'Diurno',
                        'overtime2' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage2' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality2' => 'Diurno',
                        'overtime3' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage3' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality3' => 'Diurno',
                        'overtime4' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage4' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality4' => 'Diurno',
                        'hourAbsencesLate' => ['hour' => '00', 'minute' => '00'],
                        'hourSinalCompensate' => '1',
                        'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                    ], [
                        'sequency' => '000000003',
                        'type' => '3',
                        'startDate' => '02012021',
                        'firstHour' => ['hour' => '08', 'minute' => '55'],
                        'hourCode' => '0001',
                        'dayTime' => ['hour' => '08', 'minute' => '00'],
                        'nightTime' => ['hour' => '00', 'minute' => '00'],
                        'overtime1' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage1' => ['integer' => '60', 'decimal' => '00'],
                        'overtimeModality1' => 'Noturno',
                        'overtime2' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage2' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality2' => 'Diurno',
                        'overtime3' => ['hour' => '01', 'minute' => '35'],
                        'overtimePercentage3' => ['integer' => '50', 'decimal' => '00'],
                        'overtimeModality3' => 'Diurno',
                        'overtime4' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage4' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality4' => 'Diurno',
                        'hourAbsencesLate' => ['hour' => '00', 'minute' => '00'],
                        'hourSinalCompensate' => '1',
                        'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                    ], [
                        'sequency' => '000000004',
                        'type' => '3',
                        'startDate' => '03012021',
                        'firstHour' => ['hour' => '09', 'minute' => '00'],
                        'hourCode' => '0001',
                        'dayTime' => ['hour' => '08', 'minute' => '00'],
                        'nightTime' => ['hour' => '00', 'minute' => '00'],
                        'overtime1' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage1' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality1' => 'Diurno',
                        'overtime2' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage2' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality2' => 'Diurno',
                        'overtime3' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage3' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality3' => 'Diurno',
                        'overtime4' => ['hour' => '00', 'minute' => '55'],
                        'overtimePercentage4' => ['integer' => '70', 'decimal' => '00'],
                        'overtimeModality4' => 'Diurno',
                        'hourAbsencesLate' => ['hour' => '00', 'minute' => '00'],
                        'hourSinalCompensate' => '1',
                        'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                    ], [
                        'sequency' => '000000006',
                        'type' => '3',
                        'startDate' => '04012021',
                        'firstHour' => ['hour' => '09', 'minute' => '00'],
                        'hourCode' => '0001',
                        'dayTime' => ['hour' => '08', 'minute' => '00'],
                        'nightTime' => ['hour' => '00', 'minute' => '00'],
                        'overtime1' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage1' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality1' => 'Diurno',
                        'overtime2' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage2' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality2' => 'Diurno',
                        'overtime3' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage3' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality3' => 'Diurno',
                        'overtime4' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage4' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality4' => 'Diurno',
                        'hourAbsencesLate' => ['hour' => '00', 'minute' => '55'],
                        'hourSinalCompensate' => '1',
                        'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                    ]
                ],
                '222222222222' => [
                    [
                        'sequency' => '000000002',
                        'type' => '3',
                        'startDate' => '01012021',
                        'firstHour' => ['hour' => '09', 'minute' => '01'],
                        'hourCode' => '0001',
                        'dayTime' => ['hour' => '00', 'minute' => '00'],
                        'nightTime' => ['hour' => '08', 'minute' => '00'],
                        'overtime1' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage1' => ['integer' => '50', 'decimal' => '00'],
                        'overtimeModality1' => 'Diurno',
                        'overtime2' => ['hour' => '02', 'minute' => '02'],
                        'overtimePercentage2' => ['integer' => '65', 'decimal' => '00'],
                        'overtimeModality2' => 'Noturno',
                        'overtime3' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage3' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality3' => 'Diurno',
                        'overtime4' => ['hour' => '00', 'minute' => '00'],
                        'overtimePercentage4' => ['integer' => '00', 'decimal' => '00'],
                        'overtimeModality4' => 'Diurno',
                        'hourAbsencesLate' => ['hour' => '00', 'minute' => '00'],
                        'hourSinalCompensate' => '1',
                        'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                    ], [
                        'sequency' => '000000005',
                        'type' => '3',
                        'startDate' => '04012021',
                        'firstHour' => ['hour' => '09', 'minute' => '00'],
                        'hourCode' => '0001',
                        'dayTime' => ['hour' => '08', 'minute' => '00'],
                        'nightTime' => ['hour' => '00', 'minute' => '00'],
                        'overtime1' => ['hour' => '02', 'minute' => '05'],
                        'overtimePercentage1' => ['integer' => '50', 'decimal' => '00'],
                        'overtimeModality1' => 'Diurno',
                        'overtime2' => ['hour' => '00', 'minute' => '30'],
                        'overtimePercentage2' => ['integer' => '65', 'decimal' => '00'],
                        'overtimeModality2' => 'Diurno',
                        'overtime3' => ['hour' => '00', 'minute' => '05'],
                        'overtimePercentage3' => ['integer' => '50', 'decimal' => '00'],
                        'overtimeModality3' => 'Noturno',
                        'overtime4' => ['hour' => '01', 'minute' => '10'],
                        'overtimePercentage4' => ['integer' => '10', 'decimal' => '00'],
                        'overtimeModality4' => 'Diurno',
                        'hourAbsencesLate' => ['hour' => '01', 'minute' => '00'],
                        'hourSinalCompensate' => '1',
                        'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $values);
    }

    public function testItGetsAllDataByNisFromFile()
    {
        $return = new AfdReader(__DIR__ . '/../files/acjef_test.txt');
        $values = $return->getByUser('222222222222');

        $expected = [
            '222222222222' => [
                [
                    'sequency' => '000000002',
                    'type' => '3',
                    'startDate' => '01012021',
                    'firstHour' => ['hour' => '09', 'minute' => '01'],
                    'hourCode' => '0001',
                    'dayTime' => ['hour' => '00', 'minute' => '00'],
                    'nightTime' => ['hour' => '08', 'minute' => '00'],
                    'overtime1' => ['hour' => '00', 'minute' => '00'],
                    'overtimePercentage1' => ['integer' => '50', 'decimal' => '00'],
                    'overtimeModality1' => 'Diurno',
                    'overtime2' => ['hour' => '02', 'minute' => '02'],
                    'overtimePercentage2' => ['integer' => '65', 'decimal' => '00'],
                    'overtimeModality2' => 'Noturno',
                    'overtime3' => ['hour' => '00', 'minute' => '00'],
                    'overtimePercentage3' => ['integer' => '00', 'decimal' => '00'],
                    'overtimeModality3' => 'Diurno',
                    'overtime4' => ['hour' => '00', 'minute' => '00'],
                    'overtimePercentage4' => ['integer' => '00', 'decimal' => '00'],
                    'overtimeModality4' => 'Diurno',
                    'hourAbsencesLate' => ['hour' => '00', 'minute' => '00'],
                    'hourSinalCompensate' => '1',
                    'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                ], [
                    'sequency' => '000000005',
                    'type' => '3',
                    'startDate' => '04012021',
                    'firstHour' => ['hour' => '09', 'minute' => '00'],
                    'hourCode' => '0001',
                    'dayTime' => ['hour' => '08', 'minute' => '00'],
                    'nightTime' => ['hour' => '00', 'minute' => '00'],
                    'overtime1' => ['hour' => '02', 'minute' => '05'],
                    'overtimePercentage1' => ['integer' => '50', 'decimal' => '00'],
                    'overtimeModality1' => 'Diurno',
                    'overtime2' => ['hour' => '00', 'minute' => '30'],
                    'overtimePercentage2' => ['integer' => '65', 'decimal' => '00'],
                    'overtimeModality2' => 'Diurno',
                    'overtime3' => ['hour' => '00', 'minute' => '05'],
                    'overtimePercentage3' => ['integer' => '50', 'decimal' => '00'],
                    'overtimeModality3' => 'Noturno',
                    'overtime4' => ['hour' => '01', 'minute' => '10'],
                    'overtimePercentage4' => ['integer' => '10', 'decimal' => '00'],
                    'overtimeModality4' => 'Diurno',
                    'hourAbsencesLate' => ['hour' => '01', 'minute' => '00'],
                    'hourSinalCompensate' => '1',
                    'hourBalanceCompensate' => ['hour' => '00', 'minute' => '00'],
                ]
            ]
        ];

        $this->assertEquals($expected, $values);
    }
}
