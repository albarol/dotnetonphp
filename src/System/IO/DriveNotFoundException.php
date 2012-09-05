<?php

namespace System\IO;

/**
 * The exception that is thrown when trying to access a drive or share that is not available.
 * @access public
 * @name DriveNotFoundException
 * @package System
 * @subpackage IO
 */
class DriveNotFoundException extends \Exception {

    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}
?>
