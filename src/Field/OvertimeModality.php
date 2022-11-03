<?php

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\OvertimeModalityNotExistsException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class OvertimeModality implements FieldInterface
{
    const DIURNO = 'Diurno';
    const NOTURNO = 'Noturno';

    private $types = [
        'D' => self::DIURNO,
        'N' => self::NOTURNO,
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
