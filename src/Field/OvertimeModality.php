<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Interfaces\FieldInterface;

class OvertimeModality implements FieldInterface
{
    private $types = [
        'D' => 'Diurno',
        'N' => 'Noturno',
    ];

    /**
     * Format field type.
     *
     * @param $value
     * @return mixed
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }
    }
}
