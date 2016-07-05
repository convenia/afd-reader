<?php
/**
*
* Classe para validação de Arquivo Fonte de Dados (AFD)
*
* Especificação do MTE referente a portaria 1.510/2009, especifica um padrão
* para os arquivos gerados pelos REP - Registrador Eletrônico de Ponto
* @author  Victor Ventura <euventura@gmail.com>
* @version  0.1
* @copyright  CC BY-SA 3.0 <http://creativecommons.org/licenses/by-sa/3.0/>
* @todo  Ler Arquivos AFD e AFDF e devolver em Array
*/

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidDateFormatException;
use Convenia\AfdReader\Interfaces\FieldInterface;
use \DateTime;

class Date implements FieldInterface
{
    public function format($value)
    {
        $dateObj = DateTime::createFromFormat('dmY', $value);
        if ($dateObj  === false) {
            //throw new InvalidDateFormatException('passed value:' . $value);
        }
        return $dateObj;
    }
}
