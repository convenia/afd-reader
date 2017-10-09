<?php

namespace Convenia\AfdReader\Registry\Afd;

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
            'name' => 'identityType',
            'class' => \Convenia\AfdReader\Field\IdentityType::class,
        ],
        4  => [
            'size' => 14,
            'type' => 'numeric',
            'name' => 'identityNumber',
        ],
        5  => [
            'size' => 12,
            'type' => 'numeric',
            'name' => 'cei',
        ],
        6  => [
            'size'  => 150,
            'type'  => 'alphanumeric',
            'name'  => 'name',
            'class' => \Convenia\AfdReader\Field\Alphanumeric::class,
        ],
        7  => [
            'size' => 8,
            'type' => 'numeric',
            'name' => 'SerialNumber',
        ],
        8  => [
            'size'  => 6,
            'type'  => 'numeric',
            'name'  => 'registryStartDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        9  => [
            'size'  => 6,
            'type'  => 'numeric',
            'name'  => 'registryEndDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        10 => [
            'size'  => 6,
            'type'  => 'numeric',
            'name'  => 'generationDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        11 => [
            'size'  => 4,
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
