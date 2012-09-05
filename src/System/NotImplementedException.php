<?php

/**
 * The exception that is thrown when a requested method or operation is not implemented.
 * @access public
 * @name NotImplementedException
 * @package System
 */
class NotImplementedException extends \Exception {
    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}
?>
