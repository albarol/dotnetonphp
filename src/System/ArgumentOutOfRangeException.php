<?php

namespace System {

	/**
	 * The exception that is thrown when the value of an argument is outside the allowable range of values as defined by the invoked method.
	 * @access public
	 * @name ArgumentException
	 * @package System
	 */
	class ArgumentOutOfRangeException extends \Exception {

	    public function  __construct($message="", $code=0, $previous=null) {
	            parent::__construct($message, $code, $previous);
	    }
	}
}
