<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Interfaces\FieldInterface;

class OperationType implements FieldInterface
{
    private $types = [
        'I' => 'Inclusão',
        'A' => 'Alteração',
        'E' => 'Exclusão',
    ];

    /**
     * Format field type.
     *
     * @param $value
     *
     * @return mixed
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }

        throw new OperationNotExistsException($value);
    }
}
