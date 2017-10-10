<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\IdentityNotExistsException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class IdentityType implements FieldInterface
{
    private $types = [
        '1' => 'CNPJ',
        '2' => 'CPF',
    ];

    /**
     * Format field type.
     *
     * @param $value
     * @return mixed
     * @throws \Convenia\AfdReader\Exception\IdentityNotExistsException
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }

        throw new IdentityNotExistsException($value);
    }
}
