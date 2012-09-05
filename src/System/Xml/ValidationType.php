<?php

require_once(dirname(__FILE__).'/../Enum.php');

/**
 * Specifies the type of validation to perform.
 * @access public
 * @name ValidationType
 * @package System
 * @subpackage Xml
 */
class ValidationType extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }


    /**
     * Validates if DTD or schema information is found.
     * @access public
     * @static
     * @return ValidationType
     */
    public static function auto() {
        return new ValidationType("AUTO", 0);
    }

    /**
     * Validates according to the DTD.
     * @access public
     * @static
     * @return ValidationType
     */
    public static function dtd() {
        return new ValidationType("DTD", 1);
    }

    /**
     * No validation is performed. This setting creates an XML 1.0 compliant non-validating parser.
     * @access public
     * @static
     * @return ValidationType
     */
    public static function none() {
        return new ValidationType("NONE", 2);
    }

    /**
     * Validate according to XML Schema definition language (XSD) schemas, including inline XML Schemas. XML Schemas are associated with namespace URIs either by using the schemaLocation attribute or the provided Schemas property.
     * @access public
     * @static
     * @return ValidationType
     */
    public static function schema() {
        return new ValidationType("SCHEMA", 3);
    }


    /**
     * Validate according to XML-Data Reduced (XDR) schemas, including inline XDR schemas. XDR schemas are recognized using the x-schema namespace prefix or the System.Xml.XmlValidatingReader.Schemas property.
     * @access public
     * @static
     * @return ValidationType
     */
    public static function xdr() {
        return new ValidationType("XDR", 4);
    }

}
?>