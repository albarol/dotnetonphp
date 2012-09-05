<?php

namespace System\Collections\Generic;

require_once("BaseEnumerator.php");

use \System\Collections\Queue as Queue;


/**
 * Enumerates the elements of a System.Collections.Queue.
 * @access public
 * @name QueueEnumerator
 * @package System
 * @subpackage Collections\Generic
 */
final class QueueEnumerator extends BaseEnumerator {

    public function __construct(Queue $queue) {
        $this->source = $queue->toArray();
    }
}
?>