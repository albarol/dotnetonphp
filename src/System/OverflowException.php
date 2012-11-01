<?php

namespace System {

    /**
     * The exception that is thrown when an arithmetic, casting, or conversion operation in a checked context results in an overflow.
     * @access public
     * @package System
     * @name OverflowException
    */
    class OverflowException extends \Exception {
        public function  __construct($message="", $code=0, $previous=null) {
                parent::__construct($message, $code, $previous);
        }
    }
}
