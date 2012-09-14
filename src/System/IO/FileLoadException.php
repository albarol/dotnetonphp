<?php

namespace System\IO {

	/**
	 * The exception that is thrown when a managed assembly is found but cannot be loaded.
	 * @access public
	 * @name FileLoadException
	 * @package System
	 * @subpackage IO
	 */
	class FileLoadException extends \Exception {

	    public function  __construct($message="", $code=0, $previous=null) {
	            parent::__construct($message, $code, $previous);
	    }

	}
}