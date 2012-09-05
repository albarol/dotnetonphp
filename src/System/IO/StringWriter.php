<?php

namespace System\IO;

require_once("TextWriter.php");
require_once(dirname(__FILE__).'/../text/StringBuilder.php');


use \System\IFormatProvider as IFormatProvider;
use \System\Text\StringBuilder as StringBuilder;
use \System\ObjectDisposedException as ObjectDisposedException;

 /**
  * Implements a System.IO.TextWriter for writing information to a string. The information is stored in an underlying System.Text.StringBuilder.
  * @access public
  * @name StringWriter
  * @package System
  * @subpackage IO
  */
class StringWriter extends TextWriter {


    /**
     * Initializes a new instance of the System.IO.StringWriter class that writes to the specified System.Text.StringBuilder and has the specified format provider.
     * @param \System\Text\StringBuilder $sb The StringBuilder to write to.
     * @param \System\IFormatProvider $formatProvider An System.IFormatProvider object that controls formatting.
     */
    public function __construct(StringBuilder $sb=null, IFormatProvider $formatProvider=null) {
        if(is_null($sb)) {
            $this->resource = new StringBuilder();
        } else {
            $this->resource = $sb;
        }
    }


    /**
     * Closes the current System.IO.StringWriter and the underlying stream.
     * @access public
     * @return void
     */
    public function close() {
        unset($this->resource);
    }


    /**
     * Returns the underlying System.Text.StringBuilder.
     * @access public
     * @return StringBuilder The underlying StringBuilder.
     */
    public function getStringBuilder() {
        return clone $this->resource;
    }

    /**
     * Writes the text representation of an object to the text stream by calling ToString on that object.
     * @access public
     * @throws \System\ObjectDisposedException|\System\IO\IOException
     * @param $value The object to write.
     * @return void
     */
    public function write($value) {
        if(!isset($this->resource)) throw new ObjectDisposedException("The System.IO.StringWriter is closed.");
        $this->resource->append($value);
    }


    /**
     * Writes the text representation of an object by calling ToString on this object, followed by a line terminator to the text stream.
     * @access public
     * @throws \System\ObjectDisposedException|\System\IO\IOException
     * @param object $value The object to write. If value is null, only the line termination characters are written.
     * @return void
     */
    public function writeLine($value) {
        if(!isset($this->resource)) throw new ObjectDisposedException("The System.IO.StringWriter is closed.");
        $this->resource->appendLine($value);
    }

    /**
     * When overridden in a derived class, returns the System.Text.Encoding in which the output is written.
     * @access public
     * @return Encoding The Encoding in which the output is written.
     */
    public function encoding(){}
}
?>