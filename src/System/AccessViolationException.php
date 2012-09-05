<?php

namespace System;

/**
 * The exception that is thrown when there is an attempt to read or write protected memory.
 * @access public
 * @package System
 * @name AccessViolationException
 */
class AccessViolationException extends \Exception {
   
    /**
     * Initializes a new instance of the System.AccessViolationException class with a specified error message and a reference to the inner exception that is the cause of this exception.
     * @access public
     * @param string $message The message that describes the exception. The caller of this constructor is required to ensure that this string has been localized for the current system culture.
     * @param int $code The exception that is the cause of the current exception. If the innerException parameter is not null, the current exception is raised in a catch block that handles the inner exception.
     */
    public function  __construct($message="", $code=0) {
            parent::__construct($message, $code, null);
    }
}
?>
