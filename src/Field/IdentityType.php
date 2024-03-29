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
     *
     * @throws IdentityNotExistsException
     *
     * @return mixed
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }

        throw new IdentityNotExistsException('Value must be one of "' . implode(',', array_keys($this->types)) . '"');
    }
}
