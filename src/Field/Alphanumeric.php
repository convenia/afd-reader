<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Interfaces\FieldInterface;

class Alphanumeric implements FieldInterface
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
        return trim($value);
    }
}
