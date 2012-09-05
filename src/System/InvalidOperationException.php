<?php

namespace System;

/**
 * The exception that is thrown when a method call is invalid for the object's current state.
 * @access public
 * @name InvalidOperationException
 * @package System
 */
class InvalidOperationException extends \Exception {
    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}
