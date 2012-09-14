<?php

namespace System\Collections\Generic {

	use \System\Collections\ArrayList as ArrayList;

	use \System\Collections\Generic\BaseEnumerator as BaseEnumerator;

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
}