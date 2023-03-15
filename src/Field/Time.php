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
     * @throws InvalidTimeFormatException
     *
     * @return array
     */
    public function format($value)
    {
        $value = trim($value);
        if (strlen($value) != 4 && $value != '') {
            throw new InvalidTimeFormatException('Value must be on the hhmm format.');
        }

        $hour = substr($value, 0, 2) ?: '00';
        $minute = substr($value, 2, 2) ?: '00';

        if (!preg_match('/^\d{2}$/', $hour) || !preg_match('/^\d{2}$/', $minute) || $minute > 59) {
            throw new InvalidTimeFormatException('Value must be on the hhmm format.');
        }

        return [
            'hour'   => $hour,
            'minute' => $minute,
        ];
    }
}
