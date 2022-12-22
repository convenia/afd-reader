<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidDateFormatException;
use Convenia\AfdReader\Interfaces\FieldInterface;
use DateTime;

class Date implements FieldInterface
{
    /**
     * Format field type.
     *
     * @param $value
     *
     * @throws InvalidDateFormatException
     *
     * @return \DateTime
     */
    public function format($value)
    {
        $dateObj = DateTime::createFromFormat('dmY', $value);
        if ($dateObj === false || $dateObj->format('dmY') !== $value) {
            throw new InvalidDateFormatException('Value must be a valid date in the format dmY');
        }

        return $dateObj;
    }
}
