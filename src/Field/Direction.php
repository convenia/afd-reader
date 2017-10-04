<?php
/**
 * Classe para validação de Arquivo Fonte de Dados (AFD).
 *
 * Especificação do MTE referente a portaria 1.510/2009, especifica um padrão
 * para os arquivos gerados pelos REP - Registrador Eletrônico de Ponto
 *
 * @author  Victor Ventura <euventura@gmail.com>
 *
 * @version  0.1
 *
 * @copyright  CC BY-SA 3.0 <http://creativecommons.org/licenses/by-sa/3.0/>
 */

namespace Convenia\AfdReader\Field;

use Convenia\AfdReader\Exception\DirectionNotExistsException;
use Convenia\AfdReader\Interfaces\FieldInterface;

class Direction implements FieldInterface
{
    private $types = [
        'E' => 'Entrada',
        'S' => 'Saída',
        'D' => 'Desconsiderado',
    ];

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
        if (isset($this->types[$value])) {
            return $this->types[$value];
        }
        throw new DirectionNotExistsException($value);
    }
}
