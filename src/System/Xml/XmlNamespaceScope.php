<?php

/**
 * Defines the namespace scope.
 * @access public
 * @name XmlNamespaceScope
 * @package System
 * @subpackage Xml
 */
class XmlNamespaceScope extends Enum {

    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }

    /**
     * All namespaces defined in the scope of the current node. This includes the xmlns:xml namespace which is always declared implicitly. The order of the namespaces returned is not defined.
     * @access public
     * @static
     * @return XmlNamespaceScope
     */
    public static function all() {
        return new XmlNamespaceScope("ALL", 0);
    }


    /**
     * All namespaces defined in the scope of the current node, excluding the xmlns:xml namespace, which is always declared implicitly. The order of the namespaces returned is not defined.
     * @access public
     * @static
     * @return XmlNamespaceScope
     */
    public static function excludeXml() {
        return new XmlNamespaceScope("EXCLUDE_XML", 1);
    }

    /**
     * All namespaces that are defined locally at the current node.
     * @access public
     * @static
     * @return XmlNamespaceScope
     */
    public static function local() {
        return new XmlNamespaceScope("ALL", 2);
    }

}
?>