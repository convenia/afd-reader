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

namespace Convenia\AfdReader\Registry\Afdt;

use Convenia\AfdReader\Interfaces\RegistryInterface;

class Header implements RegistryInterface
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
            'size' => 1,
            'type' => 'numeric',
            'name' => 'entityType',
        ],
        4  => [
            'size' => 14,
            'type' => 'numeric',
            'name' => 'entityNumber',
        ],
        5  => [
            'size' => 12,
            'type' => 'numeric',
            'name' => 'cei',
        ],
        6  => [
            'size' => 150,
            'type' => 'alphanumeric',
            'name' => 'name',
        ],
        7  => [
            'size'  => 8,
            'type'  => 'numeric',
            'name'  => 'startDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        8  => [
            'size'  => 8,
            'type'  => 'numeric',
            'name'  => 'endDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        9  => [
            'size'  => 8,
            'type'  => 'numeric',
            'name'  => 'generationDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        10 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'generationTime',
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
