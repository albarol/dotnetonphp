<?php

namespace System {

	/**
	 * The exception that is thrown when an invoked method is not supported, or when there is an attempt to read, seek, or write to a stream that does not support the invoked functionality.
	 * @access public
	 * @name NotSupportedException
	 * @package System
	 */
	class NotSupportedException extends \Exception {
	    public function  __construct($message="", $code=0, $previous=null) {
	            parent::__construct($message, $code, $previous);
	    }
	}
}