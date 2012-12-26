<?php

namespace System\Collections\Generic {

	use \System\Collections\BitArray as BitArray;

	use \System\Collections\Generic\BaseEnumerator as BaseEnumerator;

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
}