<?php

namespace System;

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

    /**
     * Gets a collection of key/value pairs that provide additional user-defined information about the exception.
     * @access public
     * @return IDictionary An object that implements the System.Collections.IDictionary interface and contains a collection of user-defined key/value pairs. The default is an empty collection.
     */
    public function Data() { }



    /**
     * Gets or sets a link to the help file associated with this exception.
     * @access public
     * @param $value
     * @return String $value The Uniform Resource Name (URN) or Uniform Resource Locator (URL).
     */
    public function HelpLink($value=null) { }


    /**
     * Gets or sets HRESULT, a coded numerical value that is assigned to a specific exception.
     * @access public
     * @param Int32 $value Gets or sets HRESULT, a coded numerical value that is assigned to a specific exception.
     * @return Int32 The HRESULT value.
     */
    protected function HResult($value=null) { }


}

?>
