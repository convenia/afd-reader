<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\InvalidIdentityFormatException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class IdentityNumber implements FieldInterface
{
    /**
     * Format field type.
     *
     * @param $value
     *
     * @return int
     * @throws InvalidIdentityFormatException
     */
    public function format($value)
    {
        if (!preg_match('/^\d+$/', $value)) {
            throw new InvalidIdentityFormatException('Value must be composed of only digits');
        }

        return $value;
    }
}
