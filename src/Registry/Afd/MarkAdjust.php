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

namespace Convenia\AfdReader\Registry\Afd;

use Convenia\AfdReader\Field\Numeric;
use Convenia\AfdReader\Field\Alphanumeric;
use Convenia\AfdReader\Interfaces\RegistryInterface;

class MarkAdjust implements RegistryInterface
{

    public $map = [
        1 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'nsr'
        ],
        2 => [
            'size' => 1,
            'type' => 'numeric',
            'name' => 'type'
        ],
        3 => [
            'size' => 8,
            'type' => 'numeric',
            'name' => 'dateBefore',
            'class' => \Convenia\AfdReader\Field\Date::class
        ],
        4 => [
            'size' => 4,
            'type' => 'numeric',
            'name' => 'timeBefore',
            'class' => \Convenia\AfdReader\Field\Time::class
        ],
        5 => [
            'size' => 8,
            'type' => 'numeric',
            'name' => 'dateAfter',
            'class' => \Convenia\AfdReader\Field\Date::class
        ],
        6 => [
            'size' => 4,
            'type' => 'numeric',
            'name' => 'timeAfter',
            'class' => \Convenia\AfdReader\Field\Time::class
        ]
    ];

    /**
     * Return may about line type
     * @method map
     * @return array Map
     */
    public function map()
    {
        return $this->map;
    }
}
