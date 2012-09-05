<?php

/**
 * Represents the XML type for the string. This allows the string to be read as a particular XML type, for example a CDATA section type.
 */
class XmlTokenizedType extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }


    /**
     * CDATA type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function cdata() {
        return new XmlTokenizedType("CDATA", 0);
    }

    /**
     * ENTITIES type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function entities() {
        return new XmlTokenizedType("ENTITIES", 5);
    }

    /**
     * ENTITY type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function entity() {
        return new XmlTokenizedType("ENTITY", 4);
    }

    /**
     * ID type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function id() {
        return new XmlTokenizedType("ID", 1);
    }

    /**
     * ENUMERATION type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function enumeration() {
        return new XmlTokenizedType("ENUMERATION", 9);
    }


    /**
     * IDREF type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function idRef() {
        return new XmlTokenizedType("IDREF", 2);
    }

    /**
     * IDREFS type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function idRefs() {
        return new XmlTokenizedType("IDREFS", 3);
    }

    /**
     * NCName type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function ncName() {
        return new XmlTokenizedType("NCNAME", 11);
    }

    /**
     * NMTOKEN type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function nmToken() {
        return new XmlTokenizedType("NMTOKEN", 6);
    }

    /**
     * NMTOKENS type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function nmTokens() {
        return new XmlTokenizedType("NMTOKENS", 7);
    }

    /**
     * No type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function none() {
        return new XmlTokenizedType("NONE", 12);
    }

    /**
     * NOTATION type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function notation() {
        return new XmlTokenizedType("NOTATION", 8);
    }

    /**
     * QName type.
     * @access public
     * @static
     * @return XmlTokenizedType
     */
    public static function qName() {
        return new XmlTokenizedType("QNAME", 10);
    }

}
?>