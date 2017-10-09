<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\IdentityNotExistsException;
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
     * @method format
     *
     * @param string $value value to be formated
     *
     * @return string formated value
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }

    }
}
