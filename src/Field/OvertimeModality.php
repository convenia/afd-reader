<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\OvertimeModalityNotExistsException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class OvertimeModality implements FieldInterface
{
    private $types = [
        'D' => 'Diurno',
        'N' => 'Noturno',
    ];

    /**
     * Format field type.
     *
     * @param $value
     *
     * @return mixed
     * @throws OvertimeModalityNotExistsException
     */
    public function format($value)
    {
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }

        throw new OvertimeModalityNotExistsException('Value must be one of "' . implode(',', array_keys($this->types)) . '"');
    }
}
