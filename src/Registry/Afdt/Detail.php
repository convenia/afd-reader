<?php

namespace Convenia\AfdReader\Registry\Afdt;

use Convenia\AfdReader\Interfaces\RegistryInterface;

class Detail implements RegistryInterface
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
            'size'  => 8,
            'type'  => 'numeric',
            'name'  => 'clockDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        4  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'clockTime',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        5  => [
            'size'  => 12,
            'type'  => 'numeric',
            'name'  => 'identityNumber',
            'class' => \Convenia\AfdReader\Field\IdentityNumber::class,
        ],
        6  => [
            'size' => 17,
            'type' => 'alphanumeric',
            'name' => 'serialNumber',
        ],
        7  => [
            'size'  => 1,
            'type'  => 'alphanumeric',
            'name'  => 'direction',
            'class' => \Convenia\AfdReader\Field\Direction::class,
        ],
        8  => [
            'size' => 2,
            'type' => 'numeric',
            'name' => 'directionOrder',
        ],
        9  => [
            'size'  => 1,
            'type'  => 'alphanumeric',
            'name'  => 'registryType',
        ],
        10 => [
            'size' => 100,
            'type' => 'alphanumeric',
            'name' => 'reason',
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
