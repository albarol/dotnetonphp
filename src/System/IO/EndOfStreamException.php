<?php

namespace System\IO;

/**
 * The exception that is thrown when reading is attempted past the end of a stream.
 * @name EndOfStreamException
 * @package System
 * @subpackage IO
 */
class EndOfStreamException extends \Exception {

    public function  __construct($message="", $code=0, $previous=null) {
            parent::__construct($message, $code, $previous);
    }
}
?>
