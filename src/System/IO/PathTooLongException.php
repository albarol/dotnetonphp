<?php

namespace System\IO;

/**
 * The exception that is thrown when a pathname or filename is longer than the system-defined maximum length.
 * @access public
 * @name PathTooLongException
 * @package System
 * @subpackage IO
 */
class PathTooLongException extends \Exception {

    public function  __construct($message="", $code=0, $previous=null) {
        parent::__construct($message, $code, $previous);
    }
}

?>
