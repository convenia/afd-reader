<?php

namespace Convenia\AfdReader;

use Convenia\AfdReader\Exception\FileNotFoundException;
use Convenia\AfdReader\Exception\InvalidDateFormatException;
use Convenia\AfdReader\Exception\InvalidFileTypeException;
use DateInterval;
use DatePeriod;
use DateTime;
use SplFileObject;

class AfdReader
{
    const AFDT = 'Afdt';
    const AFD = 'Afd';
    const ACJEF = 'Acjef';

    private $file;

    private $fileType;

    private $fileContents;

    private $fileArray = [];

    private $userArray = [];

    private $typePosition = 9;

    private $identityNumber;

    private $period;

    private $offset;

    private $chunkSize;

    private $typeNumber = [
        self::AFDT => [
            '1' => \Convenia\AfdReader\Registry\Afdt\Header::class,
            '2' => \Convenia\AfdReader\Registry\Afdt\Detail::class,
            '9' => \Convenia\AfdReader\Registry\Afdt\Trailer::class,
        ],
        self::AFD => [
            '1' => \Convenia\AfdReader\Registry\Afd\Header::class,
            '2' => \Convenia\AfdReader\Registry\Afd\CompanyChange::class,
            '3' => \Convenia\AfdReader\Registry\Afd\Mark::class,
            '4' => \Convenia\AfdReader\Registry\Afd\MarkAdjust::class,
            '5' => \Convenia\AfdReader\Registry\Afd\Employee::class,
            '9' => \Convenia\AfdReader\Registry\Afd\Trailer::class,
        ],
        self::ACJEF => [
            '1' => \Convenia\AfdReader\Registry\Acjef\Header::class,
            '2' => \Convenia\AfdReader\Registry\Acjef\ContractualHours::class,
            '3' => \Convenia\AfdReader\Registry\Acjef\Detail::class,
        ],
    ];

    /**
     * @throws FileNotFoundException
     * @throws InvalidFileTypeException
     */
    public function __construct(string $filePath, string $fileType = '', int $offset = 0, int $chunkSize = 0)
    {
        $this->fileType = ucfirst(strtolower($fileType ?? ''));
        $this->file = $filePath;
        $this->offset = $offset;
        $this->chunkSize = $chunkSize;

        $this->setFileContents();
        if ($fileType === '') {
            $this->fileType = $this->fileTypeMagic();
        }

        $availableTypes = [self::AFD, self::AFDT, self::ACJEF];
        if (! in_array($this->fileType, $availableTypes)) {
            throw new InvalidFileTypeException(
                'File type must be one of ' . implode(', ', $availableTypes)
            );
        }

        $this->readLines();
    }

    /**
     * Check file, if exists set content.
     *
     * @throws FileNotFoundException
     */
    private function setFileContents()
    {
        if (strpos($this->file, 'http') === false) {
            if (file_exists($this->file) === false) {
                throw new FileNotFoundException($this->file);
            }
        }

        if ($this->chunkSize === 0 && $this->offset === 0) {
            $this->fileContents = file($this->file);
            return;
        }

        $this->chunkSize = $this->chunkSize === 0 ? PHP_INT_MAX : $this->chunkSize;
        $file = new SplFileObject($this->file, 'r');
        $file->seek($this->offset);
        $currentLine = 0;
        while ($currentLine < $this->chunkSize && !$file->eof()) {
            $this->fileContents[] = $file->current();
            $currentLine++;
            $file->seek($currentLine + $this->offset);
        }
    }

    /**
     * Check file type by lines.
     *
     * @return bool|string
     */
    public function fileTypeMagic()
    {
        $trailer = ($this->fileContents[count($this->fileContents) - 2]);
        $trailer = trim($trailer);

        switch (strlen($trailer)) {
            case 34:
                return self::AFD;
            case 55:
                return self::AFDT;
            case 91:
                return self::ACJEF;
            default:
                return false;
        }
    }

    /**
     * Read content and transform in array.
     */
    private function readLines()
    {
        foreach ($this->fileContents as $value) {
            $this->fileArray[] = $this->translateToArray($value);
        }
    }

    /**
     * Translate line to array info.
     *
     * @param $content
     *
     * @return array
     */
    private function translateToArray(string $content): array
    {
        $position = 0;
        $line = [];
        $map = $this->getMap($content);
        if ($map !== false) {
            foreach ($map as $fieldMap) {
                $line[$fieldMap['name']] = substr($content, $position, $fieldMap['size']);
                if (isset($fieldMap['class'])) {
                    $field = new $fieldMap['class']($line[$fieldMap['name']]);
                    $line[$fieldMap['name']] = $field->format($line[$fieldMap['name']]);
                }
                $position = $position + $fieldMap['size'];
            }
        }

        return $line;
    }

    /**
     * Return a map by line type and file type.
     *
     * @param $content
     *
     * @return bool
     */
    private function getMap(string $content)
    {
        $type = $this->getType($content);
        if (isset($this->typeNumber[$this->fileType][$type])) {
            $registry = $this->typeNumber[$this->fileType][$type];
            $class = new $registry();

            return $class->map;
        }

        return false;
    }

    /**
     * Get type line.
     *
     * @param $content
     *
     * @return bool|string
     */
    private function getType(string $content): string
    {
        if ($this->fileType === self::AFD && strlen($content) === 47) {
            $this->typePosition = 45;
        }

        return substr($content, $this->typePosition, 1);
    }

    /**
     * Return array by user.
     *
     * @param string|null   $identityNumber
     * @param array|null $period
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    public function getByUser(string $identityNumber = null, array $period = null): array
    {
        $this->identityNumber = $identityNumber;
        $this->period = $period;

        if ($this->fileType == self::AFD) {
            return $this->getByUserAfd($this->identityNumber, $this->period);
        }

        if ($this->fileType == self::AFDT) {
            return $this->getByUserAfdt($this->identityNumber, $this->period);
        }

        return $this->getByUserAcjef($this->identityNumber, $this->period);
    }

    /**
     * Get By User on AFD files.
     *
     * @param null $identityNumber
     * @param null $period
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    private function getByUserAfd(string $identityNumber = null, array $period = null): array
    {
        if ($period) {
            $this->filter($period, 'date', 3);
        }

        if ($identityNumber) {
            $this->byIdentityNumber($identityNumber);
        }

        $this->userArray = [];
        $userControl = [];

        foreach ($this->fileArray as $value) {
            if ($this->isByUserCondition($value)) {
                if (!isset($userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')])) {
                    $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] = 'Entrada';
                    $userControl[$value['identityNumber']]['period'][$value['date']->format('dmY')] = 1;
                }

                $this->userArray[$value['identityNumber']][$value['date']->format('dmY')][$userControl[$value['identityNumber']]['period'][$value['date']->format('dmY')]][] = [
                    'sequency'  => $value['sequency'],
                    'dateTime'  => $value['date']->setTime($value['time']['hour'], $value['time']['minute']),
                    'direction' => $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')],
                ];

                if ($userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] == 'Entrada') {
                    $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] = 'Saída';
                    continue;
                }

                $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] = 'Entrada';
                $userControl[$value['identityNumber']]['period'][$value['date']->format('dmY')]++;
            }
        }

        return $this->userArray;
    }

    /**
     * Filter registry by period.
     *
     * @param $period
     * @param $key
     * @param $type
     *
     * @throws InvalidDateFormatException
     */
    private function filter($period, $key, $type)
    {
        $dates = $this->period($period);
        $this->fileArray = array_filter($this->fileArray, function ($registry) use ($dates, $key, $type) {
            if (isset($registry[$key]) && $registry['type'] == $type) {
                if (array_key_exists($registry[$key]->format('dmY'), array_flip($dates))) {
                    return $registry;
                }
            }
        });
    }

    /**
     * Filter by identityNumber.
     *
     * @param $identityNumber
     */
    private function byIdentityNumber($identityNumber)
    {
        $this->fileArray = array_filter($this->fileArray, function ($registry) use ($identityNumber) {
            if (isset($registry['identityNumber'])) {
                if ($registry['identityNumber'] == $identityNumber) {
                    return $registry;
                }
            }
        });
    }

    /**
     * Period range data.
     *
     * @param $data
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    private function period(array $data): array
    {
        $begin = new DateTime();
        $begin = $begin->createFromFormat('Y-m-d', $data['from']);

        $end = new DateTime();
        $end = $end->createFromFormat('Y-m-d', $data['to']);

        if ($begin === false || $end === false) {
            throw new InvalidDateFormatException('Passed value from: '.$data['from'].' - to: '.$data['to']);
        }

        $end = $end->modify('+1 day');

        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);

        $result = [];

        foreach ($dateRange as $date) {
            $result[] = $date->format('dmY');
        }

        return $result;
    }

    /**
     * Check Line Type on file.
     *
     * @param $value
     *
     * @return bool
     */
    private function isByUserCondition(array $value) : bool
    {
        if (!isset($value['type'])) {
            return false;
        }

        if ($this->fileType == self::AFDT && $value['type'] == 2) {
            return true;
        }

        if ($this->fileType == self::AFD && $value['type'] == 3) {
            return true;
        }

        if ($this->fileType == self::ACJEF && $value['type'] == 3) {
            return true;
        }

        return false;
    }

    /**
     * Get By User on AFDT files.
     *
     * @param null $identityNumber
     * @param null $period
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    private function getByUserAfdt(string $identityNumber = null, array $period = null): array
    {
        if ($period) {
            $this->filter($period, 'clockDate', 2);
        }

        if ($identityNumber) {
            $this->byIdentityNumber($identityNumber);
        }

        $this->userArray = [];

        foreach ($this->fileArray as $value) {
            if ($this->isByUserCondition($value)) {
                $this->userArray[$value['identityNumber']][$value['clockDate']->format('dmY')][$value['directionOrder']][] = [
                    'sequency'  => $value['sequency'],
                    'dateTime'  => $value['clockDate']->setTime($value['clockTime']['hour'], $value['clockTime']['minute']),
                    'reason'    => $value['reason'],
                    'direction' => $value['direction'],
                    'type'      => $value['registryType'],
                ];
            }
        }

        return $this->userArray;
    }

    /**
     * Get By User on ACJEF files.
     *
     * @param null $identityNumber
     * @param null $period
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    private function getByUserAcjef(string $identityNumber = null, array $period = null): array
    {
        if ($period) {
            $this->filter($period, 'startDate', 3);
        }

        if ($identityNumber) {
            $this->byIdentityNumber($identityNumber);
        }

        $this->userArray = [];

        foreach ($this->fileArray as $value) {
            if ($this->isByUserCondition($value)) {
                $this->userArray[$value['identityNumber']][] = [
                    'sequency'              => $value['sequency'],
                    'type'                  => $value['type'],
                    'startDate'             => $value['startDate']->format('dmY'),
                    'firstHour'             => $value['firstHour'],
                    'hourCode'              => $value['hourCode'],
                    'dayTime'               => $value['dayTime'],
                    'nightTime'             => $value['nightTime'],
                    'overtime1'             => $value['overtime1'],
                    'overtimePercentage1'   => $value['overtimePercentage1'],
                    'overtimeModality1'     => $value['overtimeModality1'],
                    'overtime2'             => $value['overtime2'],
                    'overtimePercentage2'   => $value['overtimePercentage2'],
                    'overtimeModality2'     => $value['overtimeModality2'],
                    'overtime3'             => $value['overtime3'],
                    'overtimePercentage3'   => $value['overtimePercentage3'],
                    'overtimeModality3'     => $value['overtimeModality3'],
                    'overtime4'             => $value['overtime4'],
                    'overtimePercentage4'   => $value['overtimePercentage4'],
                    'overtimeModality4'     => $value['overtimeModality4'],
                    'hourAbsencesLate'      => $value['hourAbsencesLate'],
                    'hourSinalCompensate'   => $value['hourSinalCompensate'],
                    'hourBalanceCompensate' => $value['hourBalanceCompensate'],
                ];
            }
        }

        return $this->userArray;
    }

    /**
     * Return array all format.
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    public function getAll(): array
    {
        if ($this->fileType == self::AFD) {
            return $this->getAllAfd();
        }

        if ($this->fileType == self::AFDT) {
            return $this->getAllAfdt();
        }

        return $this->getAllAcjef();
    }

    /**
     * Get By User on AFDT files.
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    private function getAllAfd(): array
    {
        $data = [];

        foreach ($this->fileArray as $value) {
            if (!$this->isByUserCondition($value) && array_key_exists('type', $value)) {
                if ($value['type'] == 1) {
                    $data['header'] = [
                        'sequency'          => $value['sequency'],
                        'type'              => $value['type'],
                        'identityType'      => $value['identityType'],
                        'identityNumber'    => $value['identityNumber'],
                        'cei'               => $value['cei'],
                        'name'              => $value['name'],
                        'SerialNumber'      => $value['SerialNumber'],
                        'registryStartDate' => $value['registryStartDate']->format('dmY'),
                        'registryEndDate'   => $value['registryEndDate']->format('dmY'),
                        'generationDate'    => $value['generationDate']->format('dmY'),
                        'generationTime'    => $value['generationTime'],
                    ];
                }

                if ($value['type'] == 2) {
                    $data['companyChange'][] = [
                        'nsr'             => $value['nsr'],
                        'type'            => $value['type'],
                        'date'            => $value['date']->format('dmY'),
                        'time'            => $value['time'],
                        'identityType'    => $value['identityType'],
                        'identityNumber'  => $value['identityNumber'],
                        'cei'             => $value['cei'],
                        'name'            => $value['name'],
                        'place'           => $value['place'],
                    ];
                }

                if ($value['type'] == 4) {
                    $data['markAdjust'][] = [
                        'nsr'        => $value['nsr'],
                        'type'       => $value['type'],
                        'dateBefore' => $value['dateBefore']->format('dmY'),
                        'timeBefore' => $value['timeBefore'],
                        'dateAfter'  => $value['dateAfter']->format('dmY'),
                        'timeAfter'  => $value['timeAfter'],
                    ];
                }

                if ($value['type'] == 5) {
                    $data['employee'][] = [
                        'nsr'            => $value['nsr'],
                        'type'           => $value['type'],
                        'date'           => $value['date']->format('dmY'),
                        'time'           => $value['time'],
                        'operation'      => $value['operation'],
                        'identityNumber' => $value['identityNumber'],
                        'name'           => $value['name'],
                    ];
                }

                if ($value['type'] == 9) {
                    $data['trailer'] = [
                        'sequency'    => $value['sequency'],
                        'numberType2' => $value['numberType2'],
                        'numberType3' => $value['numberType3'],
                        'numberType4' => $value['numberType4'],
                        'numberType5' => $value['numberType5'],
                        'type'        => $value['type'],
                    ];
                }
            }
        }

        $data['mark'] = $this->getByUserAfd($this->identityNumber, $this->period);

        return $data;
    }

    /**
     * Get By User on AFDT files.
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    private function getAllAfdt(): array
    {
        $data = [];

        foreach ($this->fileArray as $value) {
            if (!$this->isByUserCondition($value) && array_key_exists('type', $value)) {
                if ($value['type'] == 1) {
                    $data['header'] = $this->header($value);
                }

                if ($value['type'] == 9) {
                    $data['trailer'] = [
                        'sequency' => $value['sequency'],
                        'type'     => $value['type'],
                    ];
                }
            }
        }

        $data['detail'] = $this->getByUserAfdt($this->identityNumber, $this->period);

        return $data;
    }

    /**
     * Registry header.
     *
     * @param $value
     *
     * @return array
     */
    private function header($value): array
    {
        return [
            'sequency'       => $value['sequency'],
            'type'           => $value['type'],
            'entityType'     => $value['entityType'],
            'entityNumber'   => $value['entityNumber'],
            'cei'            => $value['cei'],
            'name'           => trim($value['name']),
            'startDate'      => $value['startDate']->format('dmY'),
            'endDate'        => $value['endDate']->format('dmY'),
            'generationDate' => $value['generationDate'],
            'generationTime' => $value['generationTime'],
        ];
    }

    /**
     * Get All on ACJEF files.
     *
     * @throws InvalidDateFormatException
     *
     * @return array
     */
    private function getAllAcjef(): array
    {
        $data = [];

        foreach ($this->fileArray as $value) {
            if (!$this->isByUserCondition($value) && array_key_exists('type', $value)) {
                if ($value['type'] == 1) {
                    $data['header'] = $this->header($value);
                }

                if ($value['type'] == 2) {
                    $data['contractualHours'][] = [
                        'sequency'    => $value['sequency'],
                        'type'        => $value['type'],
                        'hourCode'    => $value['hourCode'],
                        'startTime'   => $value['startTime'],
                        'startBreak'  => $value['startBreak'],
                        'finishBreak' => $value['finishBreak'],
                        'finishTime'  => $value['finishTime'],
                    ];
                }
            }
        }

        $data['detail'] = $this->getByUserAcjef($this->identityNumber, $this->period);

        return $data;
    }
}
