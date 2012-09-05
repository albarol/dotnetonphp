<?php

require_once(dirname(__FILE__).'/../Enum.php');

/**
 * Specifies formatting options for the System.Xml.XmlTextWriter.
 * @access public
 * @name Formatting
 * @package System
 * @subpackage Xml
 */
class Formatting extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }

    /**
     * Causes child elements to be indented according to the System.Xml.XmlTextWriter.Indentation and System.Xml.XmlTextWriter.IndentChar settings.
     * @access public
     * @static
     * @return Formatting
     */
    public static function indented() {
        return new Formatting("INDENTED", 0);
    }

    /**
     * No special formatting is applied. This is the default.
     * @access public
     * @static
     * @return Formatting
     */
    public static function none() {
        return new Formatting("NONE", 1);
    }

}
?>