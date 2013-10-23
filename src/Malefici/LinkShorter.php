<?php
/**
 * For the license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Malefici;

/**
 * Class LinkShorter
 * 
 * This class can short your links. You can convert link ID from your database to short 
 * link and back.
 * 
 * Please note, that you can break your data if you will change your custom symbols string
 * during application lifetime. Just be carefully.
 *
 * @author Malefici <sir.malefici@gmail.com>
 * @package Malefici
 */
class LinkShorter {

    /**
     * @var array
     */
    private $symbols = array();

    /**
     * @param string $symbols
     * @throws \Exception
     */
    public function __construct($symbols = null) {
        if(null === $symbols) {
            $this->symbols = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        } else {
            $symbols_array = str_split($symbols);
            
            // Let's validate digits string
            if(count(array_unique($symbols_array, \SORT_STRING)) != 62)
                throw new \Exception('Symbols string should be of 64 unique symbols');

            $this->symbols = $symbols_array;
        }
    }

    /**
     * @param int $number
     * @return string
     */
    public function intToLink($number) {
        $link = '';
        while($number != 0) {
            $digit = $number % 62;
            $link = $this->symbols[$digit] . $link;
            $number = floor($number / 62);
        }
        return $link;
    }

    /**
     * @param string $link
     * @return int
     */
    public function linkToInt($link) {
        $symbols_array = array_flip($this->symbols);
        $number = 0;
        for($i = 0; $i < strlen($link); $i++) {
            $index = $link[(strlen($link) - $i - 1)];
            $number += $symbols_array[$index] * pow(62, $i);
        }
        return $number;
    }
}