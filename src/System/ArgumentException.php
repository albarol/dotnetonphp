<?php

namespace System {

    /**
     * The exception that is thrown when one of the arguments provided to a method is not valid.
     * @access public
     * @name ArgumentException
     * @package System
     */
    class ArgumentException extends \Exception {

        public function  __construct($message="", $code=0, $previous=null) {
                parent::__construct($message, $code, $previous);
        }
    }
}
