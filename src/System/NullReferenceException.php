<?php

namespace System {

	/**
	 * The exception that is thrown when there is an attempt to dereference a null object reference.
	 * @access public
	 * @name NullReferenceException
	 * @package System
	 */
	class NullReferenceException extends \Exception {
	    public function  __construct($message="", $code=0, $previous=null) {
	            parent::__construct($message, $code, $previous);
	    }
	}

}