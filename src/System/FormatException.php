<?php

namespace System {

    /**
     * The exception that is thrown when the format of an argument does not meet the parameter specifications of the invoked method.
     * @access public
     * @name FormatException
     * @package System
    */
    class FormatException extends \Exception {
        public function  __construct($message="", $code=0, $previous=null) {
                parent::__construct($message, $code, $previous);
        }
    }

}
