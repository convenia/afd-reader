<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidOvertimePercentageException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class OvertimePercentage implements FieldInterface
{
    /**
     * Format field type.
     *
     * @param $value
     *
     * @throws \Convenia\AfdReader\Exception\InvalidOvertimePercentageException
     *
     * @return array
     */
    public function format($value)
    {
        if (strlen($value) != 4 && $value != 0) {
            throw new InvalidOvertimePercentageException($value);
        }

        return [
            'integer'   => substr($value, 0, 2),
            'decimal'   => substr($value, 2, 2),
        ];
    }
}
