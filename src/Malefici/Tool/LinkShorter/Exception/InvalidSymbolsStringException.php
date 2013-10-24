<?php
/*
 * For the license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Malefici\Tool\LinkShorter\Exception;

/**
 * Exception class thrown when invalid symbols string given
 * 
 * @author Malefici <sir.malefici@gmail.com>
 * @package Malefici\Tool\LinkShorter\Exception
 */
class InvalidSymbolsStringException extends \Exception {
    
    public function __construct($message = null, $code = 0, \Exception $previous = null, $path = null) {
        parent::__construct('Symbols string should be of 62 unique symbols', $code, $previous, $path);
    }
} 