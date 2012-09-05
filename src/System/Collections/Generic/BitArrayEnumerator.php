<?php

namespace System\Collections\Generic;

require_once('BaseEnumerator.php');

use \System\Collections\BitArray as BitArray;


/**
 * Enumerates the elements of a System.Collections.BitArray.
 * @access public
 * @name BitArrayEnumerator
 * @package System
 * @subpackage Collections\Generic
 */
final class BitArrayEnumerator extends BaseEnumerator {

    public function __construct(BitArray $bitArray) {
        for($index = 0; $index < $bitArray->count(); $index++)
            $this->source[] = $bitArray->get($index);
    }
}
?>