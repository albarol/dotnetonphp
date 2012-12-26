<?php

namespace System\Xml {

    use \System\Xml\XmlReader as XmlReader;

    /**
     * Represents a reader that provides fast, non-cached, forward-only access to XML data.
     * @access public
     * @name XmlTextReader
     * @package System
     * @subpackage Xml
     */
    class XmlTextReader extends XmlReader {

        /**
         * When overridden in a derived class, gets the value of the attribute with the specified index.
         * @access public
         * @throws ArgumentNullException|ArgumentOutOfRangeException
         * @param $value The index of the attribute. The index is zero-based. (The first attribute has index 0.)
         * @param $namespaceUri The namespace URI of the attribute.
         * @return string The value of the specified attribute. If the attribute is not found or the value is String.Empty, null is returned. This method does not move the reader.
         */
        public function getAttribute($value, $namespaceUri) {
            // TODO: Implement getAttribute() method.
        }

        /**
         * When overridden in a derived class, resolves a namespace prefix in the current element's scope.
         * @access public
         * @param $prefix The prefix whose namespace URI you want to resolve. To match the default namespace, pass an empty string.
         * @return string The namespace URI to which the prefix maps or null if no matching prefix is found.
         */
        public function lookupNamespace($prefix) {
            // TODO: Implement lookupNamespace() method.
        }
    }
}
