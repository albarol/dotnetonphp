<?php

namespace System;

/**
 * The exception that is thrown when an operation is performed on a disposed object.
 * @access public
 * @name ObjectDisposedException
 * @package System
 */
class ObjectDisposedException extends \Exception {
    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}
