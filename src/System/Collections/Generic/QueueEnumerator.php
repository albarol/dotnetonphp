<?php

namespace System\Collections\Generic {

	use \System\Collections\Queue as Queue;

	use \System\Collections\Generic\BaseEnumerator as BaseEnumerator;


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
}