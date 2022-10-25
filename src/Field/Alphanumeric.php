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
     * @param string $value value to be formatted
     *
     * @return string formatted value
     */
    public function format($value)
    {
        return trim($value);
    }
}
