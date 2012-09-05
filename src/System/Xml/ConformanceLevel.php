<?php

require_once(dirname(__FILE__).'/../Enum.php');

/**
 * Specifies the amount of input or output checking that the created System.Xml.XmlReader and System.Xml.XmlWriter objects perform.
 * @access public
 * @name ConformanceLevel
 * @package System
 * @subpackage Xml
 */
class ConformanceLevel extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }

    /**
     * The System.Xml.XmlReader or System.Xml.XmlWriter object automatically detects whether document or fragment checking should be performed, and does the appropriate checking. In the case where you are wrapping another System.Xml.XmlReader or System.Xml.XmlWriter object, the outer object does not do any additional conformance checking. Conformance checking is left up to the underlying object.
     * @access public
     * @static
     * @return ConformanceLevel
     */
    public static function auto() {
        return new ConformanceLevel("AUTO", 0);
    }

    /**
     * The XML data is in conformance to the rules for a well-formed XML 1.0 document.
     * @access public
     * @static
     * @return ConformanceLevel
     */
    public static function document() {
        return new ConformanceLevel("DOCUMENT", 1);
    }

    /**
     * The XML data is a well-formed XML fragment.
     * @access public
     * @static
     * @return ConformanceLevel
     */
    public static function fragment() {
        return new ConformanceLevel("FRAGMENT", 2);
    }
}
?>
