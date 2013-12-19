<?php
/*
 * For the license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Malefici\Tools\LinkShorter;

use Malefici\Tools\LinkShorter\Exception\InvalidSymbolsStringException;
use Malefici\Tools\LinkShorter\Exception\InvalidSymbolException;

/**
 * This class can short your links. You can convert link ID from your database to short 
 * link and back.
 * 
 * Please note, that you can break your data if you will change your custom symbols string
 * during application lifetime. Just be carefully.
 *
 * @author Malefici <sir.malefici@gmail.com>
 */
class LinkShorter {
    
    const ALL_DIGITS_AND_LETTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * @var array
     */
    private $symbols = array();

    /**
     * @param null|string $symbols
     * 
     * @throws InvalidSymbolsStringException
     */
    public function __construct($symbols = null) {
        if(null === $symbols) {
            $this->symbols = str_split(self::ALL_DIGITS_AND_LETTERS);
        } else {
            $symbols_array = str_split($symbols);
            
            if(count(array_unique($symbols_array, \SORT_STRING)) != count($symbols_array))
                throw new InvalidSymbolsStringException();

            $this->symbols = $symbols_array;
        }
    }

    /**
     * @param int $number
     * 
     * @return string
     */
    public function intToLink($number) {
        $link = '';
        while($number != 0) {
            $digit = $number % count($this->symbols);
            $link = $this->symbols[$digit] . $link;
            $number = floor($number / count($this->symbols));
        }
        return $link;
    }

    /**
     * @param string $link
     * 
     * @return int
     * 
     * @throws InvalidSymbolException
     */
    public function linkToInt($link) {        
        $symbols_array = array_flip($this->symbols);
        $number = 0;
        for($i = 0; $i < strlen($link); $i++) {
            $index = $link[(strlen($link) - $i - 1)];

            if(!in_array($index, $this->symbols)) {
                throw new InvalidSymbolException($index);
            }
            
            $number += $symbols_array[$index] * pow(count($this->symbols), $i);
        }
        return $number;
    }
}