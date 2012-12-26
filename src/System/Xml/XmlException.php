<?php

namespace System\Xml {


	/**
	 * Returns detailed information about the last exception.
	 * @access public
	 * @name XmlException
	 * @package System
	 * @subpackage Xml
	 */
	class XmlException extends \Exception {
	    public function  __construct($message="", $code=0, $previous=null) {
	            parent::__construct($message, $code, $previous);
	    }
	}

}