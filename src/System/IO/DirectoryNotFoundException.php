<?php

namespace System\IO {

	/**
	 * The exception that is thrown when part of a file or directory cannot be found.
	 * @access public
	 * @name DirectoryNotFoundException
	 * @package System
	 * @subpackage IO
	 */
	class DirectoryNotFoundException extends \Exception {

	    public function  __construct($message="", $code=0, $previous=null) {
	            parent::__construct($message, $code, $previous);
	    }
	}
}