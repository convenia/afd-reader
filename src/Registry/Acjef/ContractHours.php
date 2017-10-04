<?php
/**
 * Classe para validação de Arquivo Fonte de Dados (AFD).
 *
 * Especificação do MTE referente a portaria 1.510/2009, especifica um padrão
 * para os arquivos gerados pelos REP - Registrador Eletrônico de Ponto
 *
 * @author  Victor Ventura <euventura@gmail.com>
 *
 * @version  0.1
 *
 * @copyright  CC BY-SA 3.0 <http://creativecommons.org/licenses/by-sa/3.0/>
 */

namespace Convenia\AfdReader\Registry\Acjef;

use Convenia\AfdReader\Interfaces\RegistryInterface;

class ContractHours implements RegistryInterface
{
    public $map = [
        1  => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'sequency',
        ],
        2  => [
            'size' => 1,
            'type' => 'numeric',
            'name' => 'type',
        ],
        3  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'hourCode',
        ],
        4  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'startTime',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        5  => [
            'size' => 4,
            'type' => 'numeric',
            'name' => 'startBreak',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        6  => [
            'size' => 4,
            'type' => 'numeric',
            'name' => 'endBreak',
        ],
        7  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'endTime',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],

    ];

    /**
     * Return may about line type.
     *
     * @method map
     *
     * @return array Map
     */
    public function map()
    {
        return $this->map;
    }
}
