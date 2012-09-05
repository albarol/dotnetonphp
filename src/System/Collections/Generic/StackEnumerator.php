<?php

namespace System\Collections\Generic;

require_once('BaseEnumerator.php');

use System\Collections\Stack as Stack;


/**
 * Enumerates the elements of a System.Collections.Stack.
 * @access public
 * @name StackEnumerator
 * @package System
 * @subpackage Collections\Generic
 */
final class StackEnumerator extends BaseEnumerator {

    public function __construct(Stack $stack) {
        $this->source = $stack->toArray();
    }
}
?>