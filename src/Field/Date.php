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
     * @method format
     *
     * @param string $value value to be formated
     *
     * @return string formated value
     */
    public function format($value)
    {
        $dateObj = new DateTime();
        $dateObj = $dateObj->createFromFormat('dmY', $value);
        if ($dateObj === false) {
            throw new InvalidDateFormatException('passed value:'.$value);
        }

        return $dateObj;
    }
}
