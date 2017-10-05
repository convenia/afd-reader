<?php

namespace Convenia\AfdReader\Registry\Afd;

use Convenia\AfdReader\Interfaces\RegistryInterface;

class Trailer implements RegistryInterface
{
    public $map = [
        1 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'sequency',
        ],
        2 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'numberType2',
        ],
        3 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'numberType2',
        ],
        4 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'numberType3',
        ],
        5 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'numberType4',
        ],
        6 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'numberType5',
        ],
        7 => [
            'size' => 1,
            'type' => 'numeric',
            'name' => 'type',
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
