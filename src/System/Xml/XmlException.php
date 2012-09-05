<?php

namespace System\Xml;

require_once(dirname(__FILE__). '/../SystemException.php');

/**
 * Returns detailed information about the last exception.
 * @access public
 * @name XmlException
 * @package System
 * @subpackage Xml
 */
class XmlException extends \System\SystemException {
    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}

?>
