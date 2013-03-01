<?php

namespace System\IO;

/**
 * The exception thrown when the internal buffer overflows.
 * @access public
 * @name InternalBufferOverFlowException
 * @package System
 * @subpackage IO
 */
class InternalBufferOverFlowException extends \Exception {

    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }

}
?>