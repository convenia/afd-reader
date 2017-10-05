<?php

namespace Convenia\AfdReader\Registry\Afd;

use Convenia\AfdReader\Interfaces\RegistryInterface;

class CompanyChange implements RegistryInterface
{
    public $map = [
        1 => [
            'size' => 9,
            'type' => 'numeric',
            'name' => 'nsr',
        ],
        2 => [
            'size' => 1,
            'type' => 'numeric',
            'name' => 'type',
        ],
        3 => [
            'size'  => 6,
            'type'  => 'numeric',
            'name'  => 'date',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        4 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'time',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        5 => [
            'size' => 1,
            'type' => 'numeric',
            'name' => 'identityType',
        ],
        6 => [
            'size' => 14,
            'type' => 'numeric',
            'name' => 'idenitityNumber',
        ],
        7 => [
            'size'  => 12,
            'type'  => 'alphanumeric',
            'name'  => 'cei',
            'class' => \Convenia\AfdReader\Field\Alphanumeric::class,
        ],
        8 => [
            'size'  => 150,
            'type'  => 'numeric',
            'name'  => 'name',
            'class' => \Convenia\AfdReader\Field\Alphanumeric::class,
        ],
        9 => [
            'size'  => 1,
            'type'  => 'alphanumeric',
            'name'  => 'place',
            'class' => \Convenia\AfdReader\Field\Alphanumeric::class,
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
