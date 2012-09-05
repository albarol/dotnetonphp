<?php

namespace System\IO;

/**
 * The exception that is thrown when an attempt to access a file that does not exist on disk fails.
 * @access public
 * @name FileNotFoundException
 * @package System
 * @subpackage IO
 */
class FileNotFoundException extends \Exception {
    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}

?>
