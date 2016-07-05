<?php
/**
*
* Leitura e transformação do aquivo AFD e AFDT(AFD)
*
* Especificação do MTE referente a portaria 1.510/2009, especifica um padrão
* para os arquivos gerados pelos REP - Registrador Eletrônico de Ponto
* @author  Victor Ventura <euventura@gmail.com>
* @version  0.1
* @copyright  CC BY-SA 3.0 <http://creativecommons.org/licenses/by-sa/3.0/>
* @todo  Ler Arquivos AFD e AFDF e devolver em Array
*/

namespace Convenia\AfdReader;

use Header;
use Detail;
use Trailer;
use Convenia\AfdReader\Exception\FileNotFoundException;
use Convenia\AfdReader\Exception\WrongFileTipeException;
use Convenia\AfdReader\field;

class AfdReader
{
    private $file;
    private $fileType;
    private $fileContents;
    private $fileArray = [];
    private $userArray = [];
    private $typePosition = 9;
    private $typeNumber = [
        'Afdt' => [
            '1' => \Convenia\AfdReader\Registry\Afdt\Header::class,
            '2' => \Convenia\AfdReader\Registry\Afdt\Detail::class,
            '9' => \Convenia\AfdReader\Registry\Afdt\Trailer::class,
        ],
        'Afd' => [
            '1' => \Convenia\AfdReader\Registry\Afd\Header::class,
            '2' => \Convenia\AfdReader\Registry\Afd\CompanyChange::class,
            '3' => \Convenia\AfdReader\Registry\Afd\Mark::class,
            '4' => \Convenia\AfdReader\Registry\Afd\MarkAdjust::class,
            '5' => \Convenia\AfdReader\Registry\Afd\Employee::class,
        ]
    ];

    public function __construct($filePath, $fileType = null)
    {
        $this->fileType = $fileType;
        $this->file = $filePath;
        $this->setFileContents();

        if ($fileType === null) {
            $this->fileType = $this->fileTypeMagic();
        }

        $this->readLines();

    }

    public function getByUserAfd()
    {
        $userControl = [];
        foreach ($this->fileArray as $i => $value) {
            if ($this->getByUserCondition($value)) {
                if (!isset($userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')])) {
                    $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] = 'Entrada';
                    $userControl[$value['identityNumber']]['period'][$value['date']->format('dmY')] = 1;
                }
                $this->userArray[$value['identityNumber']][$value['date']->format('dmY')][$userControl[$value['identityNumber']]['period'][$value['date']->format('dmY')]][] = [
                    'sequency' => $value['sequency'],
                    'dateTime' => $value['date']->setTime($value['time']['hour'], $value['time']['minute']),
                    'direction' =>  $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')],
                ];

                if ($userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] == 'Entrada') {
                    $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] = 'Saída';
                } else {
                    $userControl[$value['identityNumber']]['direction'][$value['date']->format('dmY')] = 'Entrada';
                    $userControl[$value['identityNumber']]['period'][$value['date']->format('dmY')] ++;
                }
            }
        }
        return $this->userArray;
    }

    public function getByUser()
    {
        if ($this->fileType  == 'Afd') {
            return $this->getByUserAfd();
        } elseif ($this->fileType  == 'Afdt') {
            return $this->getByUserAfdt();
        }
    }

    public function getByUserAfdt()
    {
        foreach ($this->fileArray as $i => $value) {
            if ($this->getByUserCondition($value)) {
                $this->userArray[$value['identityNumber']][$value['clockDate']->format('dmY')][$value['directionOrder']][] = [
                    'sequency' => $value['sequency'],
                    'dateTime' => $value['clockDate']->setTime($value['clockTime']['hour'], $value['clockTime']['minute']),
                    'reazon' =>  $value['reason'],
                    'direction' =>  $value['direction'],
                    'type' =>  $value['registryType']
                ];
            }
        }
        return $this->userArray;
    }

    public function getByUserCondition($value)
    {
        if (!isset($value['type'])) {
            return false;
        }

        if ($this->fileType == 'Afdt' && $value['type'] == 2) {
            return true;
        }

        if ($this->fileType == 'Afd' && $value['type'] == 3) {
            return true;
        }
        return false;
    }

    public function getLines()
    {
        return $this->fileArray;
    }

    public function setFileContents()
    {
        if (file_exists($this->file)) {
            $this->fileContents = file($this->file);
        } else {
            throw new FileNotFoundException($this->file);
        }
    }

    public function readLines()
    {
        foreach ($this->fileContents as $key => $value) {
            $this->fileArray[] = $this->translateToArray($value);
        }
    }

    public function fileTypeMagic()
    {
        $trailer = ($this->fileContents[count($this->fileContents)-1]);
        $trailer = trim($trailer);
        if (strlen($trailer) == 10) {
            return 'Afdt';
        } else {
            return 'Afd';
        }
    }

    public function translateToArray($content)
    {
        $position = 0;
        $line = [];
        $map = $this->getMap($content);
        if ($map !== false) {
            foreach ($map as $i => $fieldMap) {
                $line[$fieldMap['name']] = substr($content, $position, $fieldMap['size']);
                if (isset($fieldMap['class'])) {
                    $field = new $fieldMap['class']($line[$fieldMap['name']] );
                    $line[$fieldMap['name']]  = $field->format($line[$fieldMap['name']]);
                }
                $position = $position + $fieldMap['size'];
            }
        }
        return $line;
    }

    private function getType($content)
    {
        return substr($content, $this->typePosition, 1);
    }

    private function getMap($content)
    {
        $type = $this->getType($content);
        if (isset($this->typeNumber[$this->fileType][$type])) {
            $classMap = new $this->typeNumber[$this->fileType][$type]();
            return $classMap->map;
        }
        return false;
    }
}
