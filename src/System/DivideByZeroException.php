<?php

namespace System {

    /**
     * The exception that is thrown when there is an attempt to divide an integral or decimal value by zero.
     * @access public
     * @package System
     * @name DivideByZeroException
     */
    class DivideByZeroException extends \Exception {

        public function  __construct($message="", $code=0, $previous=null) {
                parent::__construct($message, $code, $previous);
        }
    }
}
