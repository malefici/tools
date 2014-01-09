<?php
/*
 * For the license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Malefici\Tools\LinkShorter\Exception;

/**
 * Exception class thrown when invalid symbols string given
 * 
 * @author Malefici <sir.malefici@gmail.com>
 */
class InvalidSymbolsStringException extends \Exception 
{
    public function __construct() 
    {
        parent::__construct('Symbols string must contain only unique symbols');
    }
}