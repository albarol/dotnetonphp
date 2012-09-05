<?php

namespace System\Collections\Generic;

require_once("BaseEnumerator.php");

use \System\Collections\ArrayList as ArrayList;

/**
 * Enumerates the elements of a System.Collections.ArrayList.
 * @access public
 * @name ArrayListEnumerator
 * @package System
 * @subpackage Collections\Generic
 */
final class ArrayListEnumerator extends BaseEnumerator {

    public function __construct(ArrayList $arrayList) {
        $this->source = $arrayList->toArray();
    }
}
?>