<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\RegistryNotExistsException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class RegistryType implements FieldInterface
{
    private $types = [
        'O' => 'Original',
        'I' => 'Incluído por digitação',
        'P' => 'Pré-assinalado',
    ];

    /**
     * Format field type.
     *
     * @param $value
     *
     * @throws RegistryNotExistsException
     *
     * @return string
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }

        throw new RegistryNotExistsException('Value must be one of "' . implode(',', array_keys($this->types)) . '"');
    }
}
