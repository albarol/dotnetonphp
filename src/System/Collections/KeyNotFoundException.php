<?php

namespace System\Collections {

    /**
     * The exception that is thrown when the key specified for accessing an element in a collection does not match any key in the collection.
     *
     * @access public
     * @name KeyNotFoundException
     * @package System
     * @subpackage Collections
     */
    class KeyNotFoundException extends \Exception {

        public function  __construct($message="", $code=0, $previous=null) {
                parent::__construct($message, $code, $previous);
        }
    }
}
