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
     * @param $value
     *
     * @throws DirectionNotExistsException
     *
     * @return mixed
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }

        throw new DirectionNotExistsException('Value must be one of "' . implode(',', array_keys($this->types)) . '"');
    }
}
