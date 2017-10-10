<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidTimeFormatException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class Time implements FieldInterface
{
    /**
     * Format field type.
     *
     * @param $value
     *
     * @throws \Convenia\AfdReader\Exception\InvalidTimeFormatException
     *
     * @return array
     */
    public function format($value)
    {
        if (strlen($value) != 4 && $value != 0) {
            throw new InvalidTimeFormatException($value);
        }

        return [
            'hour'   => substr($value, 0, 2),
            'minute' => substr($value, 2, 2),
        ];
    }
}
