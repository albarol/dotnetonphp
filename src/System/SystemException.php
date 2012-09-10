<?php

namespace System {

    /**
     * Defines the base class for predefined exceptions in the System namespace.
     * @access public
     * @package System
     * @name SystemException
     */
    class SystemException extends \Exception {

        public function  __construct($message="", $code=0, $previous=null) {
                parent::__construct($message, $code, $previous);
        }

    }
}