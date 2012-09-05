<?php

namespace System\IO;


/**
 * The exception that is thrown when a data stream is in an invalid format.
 * @access public
 * @name InvalidDataException
 * @package System
 * @subpackage IO
 */
class InvalidDataException extends \Exception {

    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}
?>
