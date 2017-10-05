<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\DirectionNotExistsException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class Direction implements FieldInterface
{
    private $types = [
        'E' => 'Entrada',
        'S' => 'Saída',
        'D' => 'Desconsiderado',
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
        throw new DirectionNotExistsException($value);
    }
}
