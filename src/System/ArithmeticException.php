<?php

namespace System {

    /**
     * The exception that is thrown for errors in an arithmetic, casting, or conversion operation.
     * @access public
     * @name ArithmeticException
     * @package System
     */
    class ArithmeticException extends \Exception {

        public function  __construct($message="", $code=0, $previous=null) {
                parent::__construct($message, $code, $previous);
        }

    }
}
