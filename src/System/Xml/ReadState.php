<?php

require_once(dirname(__FILE__).'/../Enum.php');

/**
 * Specifies the state of the reader.
 * @access public
 * @name ReadState
 * @package System
 * @subpackage Xml
 */
class ReadState extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }


    /**
     * The System.Xml.XmlReader.Close() method has been called.
     * @access public
     * @static
     * @return ReadState
     */
    public static function closed() {
        return new ReadState("CLOSED", 0);
    }

    /**
     * The end of the file has been reached successfully.
     * @access public
     * @static
     * @return ReadState
     */
    public static function endOfFile() {
        return new ReadState("END_OF_FILE", 1);
    }

    /**
     * An error occurred that prevents the read operation from continuing.
     * @access public
     * @static
     * @return ReadState
     */
    public static function error() {
        return new ReadState("ERROR", 2);
    }


    /**
     * The Read method has not been called.
     * @access public
     * @static
     * @return ReadState
     */
    public static function initial() {
        return new ReadState("INITIAL", 3);
    }


    /**
     * The Read method has been called. Additional methods may be called on the reader.
     * @access public
     * @static
     * @return ReadState
     */
    public static function interactive() {
        return new ReadState("INTERACTIVE", 4);
    }
}
?>
