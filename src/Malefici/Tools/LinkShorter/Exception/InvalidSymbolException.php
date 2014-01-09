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
class InvalidSymbolException extends \Exception 
{
    /**
     * @param string $symbol
     */
    public function __construct($symbol) 
    {
        parent::__construct(sprintf('This symbol %s didn\'t exist in symbols collection for decoding', $symbol));
    }
} 