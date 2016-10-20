<?php
/**
* Leitura e transformação do aquivo AFD e AFDT(AFD).
*
* Especificação do MTE referente a portaria 1.510/2009, especifica um padrão
* para os arquivos gerados pelos REP - Registrador Eletrônico de Ponto
*
* @author  Victor Ventura <euventura@gmail.com>
*
* @version  0.1
*
* @copyright  CC BY-SA 3.0 <http://creativecommons.org/licenses/by-sa/3.0/>
*
* @todo  Ler Arquivos AFD e AFDF e devolver em Array
*/
namespace Convenia\AfdReader;

use Convenia\AfdReader\Exception\FileNotFoundException;

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
        ],
    ];

    /**
     * [__construct description].
     *
     * @method __construct
     *
     * @param string $filePath file Path
     * @param string $fileType Optional type [afd|afdt]
     */
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

    /**
     * Get By User on AFD files.
     *
     * @method getByUserAfd
     *
     * @return array() By user formated array
     */
    public function getByUserAfd()
    {
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
     * Return arry by user formated.
     *
     * @method getByUser
     *
     * @return array() By user formated array
     */
    public function getByUser()
    {
        if ($this->fileType == 'Afd') {
            return $this->getByUserAfd();
        } elseif ($this->fileType == 'Afdt') {
            return $this->getByUserAfdt();
        }
    }

    /**
     * Get By User on AFDT files.
     *
     * @method getByUserAfd
     *
     * @return array() By user formated array
     */
    public function getByUserAfdt()
    {
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
     * Check Line Type on file.
     *
     * @method isByUserCondition
     *
     * @param string $value Full line
     *
     * @return bool If kind of line can be formated to output array
     */
    private function isByUserCondition($value)
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

    /**
     * Get Lines.
     *
     * @method getLines
     *
     * @return array lines array
     */
    public function getLines()
    {
        return $this->fileArray;
    }

    /**
     * check file, if exists set content.
     *
     * @method setFileContents
     */
    public function setFileContents()
    {
        if (file_exists($this->file) === false) {
            throw new FileNotFoundException($this->file);
        }

        $this->fileContents = file($this->file);
    }

    /**
     * Read de Content and transforma in array.
     *
     * @method readLines
     *
     * @return array return array of lines
     */
    public function readLines()
    {
        foreach ($this->fileContents as $value) {
            $this->fileArray[] = $this->translateToArray($value);
        }
    }

    /**
     * Check file type by lines.
     *
     * @method fileTypeMagic
     *
     * @return atring Type of files [afd|afdt]
     */
    public function fileTypeMagic()
    {
        $trailer = ($this->fileContents[count($this->fileContents) - 1]);
        $trailer = trim($trailer);
        if (strlen($trailer) == 10) {
            return 'Afdt';
        }

        return 'Afd';
    }

    /**
     * Translate line to array info.
     *
     * @method translateToArray
     *
     * @param string $content line
     *
     * @return array line content
     */
    public function translateToArray($content)
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
     * Get type line.
     *
     * @method getType
     *
     * @param string $content full line
     *
     * @return string return numeric type of a line
     */
    private function getType($content)
    {
        return substr($content, $this->typePosition, 1);
    }

    /**
     * Return a map by line type and file type.
     *
     * @method getMap
     *
     * @param [type] $content full line
     *
     * @return array|boll return line map or false
     */
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
