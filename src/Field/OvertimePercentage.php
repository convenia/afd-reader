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
     * @throws InvalidOvertimePercentageException
     *
     * @return array
     */
    public function format($value)
    {
        if (strlen($value) != 4 && $value != 0) {
            throw new InvalidOvertimePercentageException('Value must be a valid integer with exact 4 digits');
        }

        $integer = substr($value, 0, 2) ?: '00';
        $decimal = substr($value, 2, 2) ?: '00';

        if (!preg_match('/^\d{2}$/', $integer) || !preg_match('/^\d{2}$/', $decimal) || $integer < 0 || $decimal < 0) {
            throw new InvalidOvertimePercentageException('Value must be a valid integer and greater than zero');
        }

        return [
            'integer'   => $integer,
            'decimal'   => $decimal,
        ];
    }
}
