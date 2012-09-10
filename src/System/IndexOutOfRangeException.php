<?php

namespace System { 

	/**
	 * The exception that is thrown when an attempt is made to access an element of an array with an index that is outside the bounds of the array. This class cannot be inherited.
	 * @access public
	 * @name IndexOutOfRangeException
	 * @package System
	 */
	class IndexOutOfRangeException extends \Exception {
	    public function  __construct($message="", $code=0, $previous=null) {
	            parent::__construct($message, $code, $previous);
	    }
	}
}