<?php

namespace System\Xml { 

    use \System\Xml\XmlLinkedNode as XmlLinkedNode;

     /**
     * Represents the XML declaration node <?xml version='1.0'...?>.
     * @access public
     * @name XmlDeclaration
     * @package System
     * @subpackage Xml
     */
    class XmlDeclaration extends XmlLinkedNode {

        private $version;
        private $encoding;
        private $standalone;

        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        public function __construct($version, $encoding, $standalone) {
            //parent::__construct($node);
            $this->version = $version;
            $this->encoding = $encoding;
            $this->standalone = $standalone;
        }

        /**
         * Overridden. Creates a duplicate of the node.
         * @access public
         * @throws \System\InvalidOperationException This node is of a type that does not allow child nodes of the type of the newChild node.
         * @param bool $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
         * @return \System\Xml\XmlNode The cloned node.
         */
        public function cloneNode($deep) {
            
        }

        /**
         * The IXPathNavigable type exposes the following members.
         * @access public
         * @return IXPathNavigable Returns a new XPathNavigator object.
         */
        public function createNavigator() {
            // TODO: Implement createNavigator() method.
        }

        /**
         * Gets or sets the encoding level of the XML document. 
         * @access public
         * @param string $value The valid character encoding name.
         * @return string Gets the encoding level of the XML document. 
         */
        public function encoding($value=null) {
            if (!is_null($value)) {
                $this->encoding = $value;
            }
            return $this->encoding;
        }

        /**
         * When overridden in a derived class, gets the local name of the node.
         * @access public
         * @return string The name of the node with the prefix removed. For example, LocalName is book for the element
         */
        public function localName() {
            return $this->node->localName;
        }

        /**
         * When overridden in a derived class, gets the qualified name of the node.
         * @access public
         * @return string The qualified name of the node. The name returned is dependent on the System.Xml.XmlNode.NodeType of the node
         */
        public function name() {
            return $this->node->nodeName;
        }

        /**
         * When overridden in a derived class, gets the type of the current node.
         * @access public
         * @return XmlNodeType One of the System.Xml.XmlNodeType values.
         */
        public function nodeType() {
            return XmlNodeType::element();
        }

        /**
         * Gets or sets the value of the standalone attribute.
         * @access public
         * @param string $value Valid values are yes if all entity declarations required by the XML document are contained within the document or no if an external document type definition (DTD) is required. If a standalone attribute is not present in the XML declaration, this property returns String.Empty. 
         * @return string Gets the value of the standalone attribute. 
         */
        public function standalone($value=null) {
            if (!is_null($value)) {
                $this->standalone = $value;
            }
            return $this->standalone;
        }

        /**
         * Gets the XML version of the document.
         * @access public
         * @param string $value Valid values are yes if all entity declarations required by the XML document are contained within the document or no if an external document type definition (DTD) is required. If a standalone attribute is not present in the XML declaration, this property returns String.Empty. 
         * @return string Gets the XML version of the document. 
         */
        public function version() {
            return $this->version;
        }

        /**
         * When overridden in a derived class, saves all the child nodes of the node to the specified System.Xml.XmlWriter.
         * @access public
         * @param XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeContentTo(XmlWriter $w) {
            // TODO: Implement writeContentTo() method.
        }

        /**
         * When overridden in a derived class, saves the current node to the specified System.Xml.XmlWriter.
         * @access public
         * @param XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeTo(XmlWriter $w) {
            // TODO: Implement writeTo() method.
        }
    }
}