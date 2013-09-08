<?php

namespace System\IO;

/**
 * The exception that is thrown when an I/O error occurs.
 * @access public
 * @name IOException
 * @package System
 * @subpackage IO
 */
class IOException extends \Exception {

    public function  __construct($message="", $code=0, $previous=null) {
        parent::__construct($message, $code, $previous);
    }
}
?>
