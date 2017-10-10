<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Interfaces\FieldInterface;

class IdentityNumber implements FieldInterface
{

    /**
     * Format field type.
     *
     * @param $value
     * @return int
     */
    public function format($value)
    {
        return (int) $value;
    }
}
