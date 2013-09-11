<?php

namespace System {

    /**
     * The exception that is thrown when a null reference is passed to a method that does not accept it as a valid argument.
     * @access public
     * @name ArgumentNullException
     * @package System
     */
    class ArgumentNullException extends \Exception {

        public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
        }
    }
}
