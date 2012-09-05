<?php

namespace System\Xml;

/**
 * Represents a reader that provides fast, non-cached, forward-only access to XML data.
 * @access public
 * @name XmlReader
 * @package System
 * @subpackage Xml
 */
abstract class XmlReader {

    /**
     * Creates a new System.Xml.XmlReader instance using the specified URI, System.Xml.XmlReaderSettings, and System.Xml.XmlParserContext objects.
     * @access public
     * @throws ArgumentNullException|SecurityException|ArgumentException|FileNotFoundException|UriFormatException
     * @static
     * @param $value
     * @param $settings The System.Xml.XmlReaderSettings object used to configure the new System.Xml.XmlReader instance. This value can be null.
     * @param $context The System.Xml.XmlParserContext object that provides the context information required to parse the XML fragment. The context information can include the System.Xml.XmlNameTable to use, encoding, namespace scope, the current xml:lang and xml:space scope, base URI, and document type definition.
     * @return XmlReader An System.Xml.XmlReader object to read XML data.
     */
    public static function create($value, $settings, $context) { }

    /**
     * When overridden in a derived class, gets the value of the attribute with the specified index.
     * @access public
     * @throws ArgumentNullException|ArgumentOutOfRangeException
     * @abstract
     * @param $value The index of the attribute. The index is zero-based. (The first attribute has index 0.)
     * @param $namespaceUri The namespace URI of the attribute.
     * @return string The value of the specified attribute. If the attribute is not found or the value is String.Empty, null is returned. This method does not move the reader.
     */
    public abstract function getAttribute($value, $namespaceUri);


    /**
     * Gets a value indicating whether the string argument is a valid XML name.
     * @access public
     * @static
     * @param $str The name to validate.
     * @return bool true if the name is valid; otherwise, false.
     */
    public static function isName($str) { }

    
    /**
     * Gets a value indicating whether or not the string argument is a valid XML name token.
     * @access public
     * @static
     * @param $str The name token to validate. 
     * @return bool true if it is a valid name token; otherwise false.
     */
    public static function isNameToken($str) { }


    /**
     * Calls System.Xml.XmlReader.MoveToContent and tests if the current content node is a start tag or empty element tag.
     * @access public
     * @throws XmlException
     * @param $name The string matched against the Name property of the element found.
     * @return bool true if System.Xml.XmlReader.MoveToContent finds a start tag or empty element tag; false if a node type other than XmlNodeType.Element was found.
     */
    public function isStartElement($name) { }

    /**
     * When overridden in a derived class, resolves a namespace prefix in the current element's scope.
     * @access public
     * @abstract
     * @param $prefix The prefix whose namespace URI you want to resolve. To match the default namespace, pass an empty string.
     * @return string The namespace URI to which the prefix maps or null if no matching prefix is found.
     */
    public abstract function lookupNamespace($prefix);




    /**
     * Reads the text content at the current position as a System.String object.
     * @access public
     * @throws InvalidCastException|FormatException
     * @return string The text content as a System.String object.
     */
    public function readContentAsString() { }



    /**
     * When overridden in a derived class, reads the content, including markup, representing this node and all its children.
     * @access public
     * @throws XmlException
     * @return string If the reader is positioned on an element or an attribute node, this method returns all the XML content, including markup, of the current node and all its children; otherwise, it returns an empty string.
     */
    public function readOuterXml() { }

}
?>
