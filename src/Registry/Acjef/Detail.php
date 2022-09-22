<?php

namespace Convenia\AfdReader\Registry\Acjef;

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
            'size'  => 12,
            'type'  => 'numeric',
            'name'  => 'identityNumber',
            'class' => \Convenia\AfdReader\Field\IdentityNumber::class,
        ],
        4  => [
            'size'  => 8,
            'type'  => 'numeric',
            'name'  => 'startDate',
            'class' => \Convenia\AfdReader\Field\Date::class,
        ],
        5  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'firstHour',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        6  => [
            'size' => 4,
            'type' => 'numeric',
            'name' => 'hourCode',
        ],
        7  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'dayTime',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        8  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'nightTime',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        9  => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtime1',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        10 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtimePercentage1',
            'class' => \Convenia\AfdReader\Field\OvertimePercentage::class,
        ],
        11 => [
            'size'  => 1,
            'type'  => 'alphanumeric',
            'name'  => 'overtimeModality1',
            'class' => \Convenia\AfdReader\Field\OvertimeModality::class,
        ],
        12 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtime2',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        13 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtimePercentage2',
            'class' => \Convenia\AfdReader\Field\OvertimePercentage::class,
        ],
        14 => [
            'size'  => 1,
            'type'  => 'alphanumeric',
            'name'  => 'overtimeModality2',
            'class' => \Convenia\AfdReader\Field\OvertimeModality::class,
        ],
        15 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtime3',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        16 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtimePercentage3',
            'class' => \Convenia\AfdReader\Field\OvertimePercentage::class,
        ],
        17 => [
            'size'  => 1,
            'type'  => 'alphanumeric',
            'name'  => 'overtimeModality3',
            'class' => \Convenia\AfdReader\Field\OvertimeModality::class,
        ],
        18 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtime4',
            'class' => \Convenia\AfdReader\Field\Time::class,
        ],
        19 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'overtimePercentage4',
            'class' => \Convenia\AfdReader\Field\OvertimePercentage::class,
        ],
        20 => [
            'size'  => 1,
            'type'  => 'alphanumeric',
            'name'  => 'overtimeModality4',
            'class' => \Convenia\AfdReader\Field\OvertimeModality::class,
        ],
        21 => [
            'size' => 4,
            'type' => 'numeric',
            'name' => 'hourAbsencesLate',
        ],
        22 => [
            'size' => 1,
            'type' => 'numeric',
            'name' => 'hourSinalCompensate',
        ],
        23 => [
            'size'  => 4,
            'type'  => 'numeric',
            'name'  => 'hourBalanceCompensate',
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
