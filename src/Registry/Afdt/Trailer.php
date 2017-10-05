<?php

namespace Convenia\AfdReader\Registry\Afdt;

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
