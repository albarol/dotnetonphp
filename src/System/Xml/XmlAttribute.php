<?php

namespace System\Xml { 

    use \System\Xml\XmlNode as XmlNode;
    use \System\Xml\XmlNodeType as XmlNodeType;


    /**
     * Represents an attribute. Valid and default values for the attribute are defined in a document type definition (DTD) or schema.
     * @access public
     * @name XmlAttribute
     * @package System
     * @subpackage Xml
     */
    class XmlAttribute extends XmlNode {

        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        public function __construct(\DOMNode $node) {
            parent::__construct($node);
        }

        /**
         * When overridden in a derived class, creates a duplicate of the node.
         * @access public
         * @throws InvalidOperationException
         * @param bool $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
         * @return XmlNode The cloned node.
         */
        public function cloneNode($deep)
        {
            // TODO: Implement cloneNode() method.
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
         * When overridden in a derived class, gets the local name of the node.
         * @access public
         * @return string The name of the node with the prefix removed. For example, LocalName is book for the element
         */
        public function localName()
        {
            // TODO: Implement localName() method.
        }

        /**
         * When overridden in a derived class, gets the qualified name of the node.
         * @access public
         * @return string The qualified name of the node. The name returned is dependent on the System.Xml.XmlNode.NodeType of the node
         */
        public function name()
        {
            // TODO: Implement name() method.
        }

        /**
         * When overridden in a derived class, gets the type of the current node.
         * @access public
         * @return XmlNodeType One of the System.Xml.XmlNodeType values.
         */
        public function nodeType() {
            return XmlNodeType::Attribute;
        }

        /**
         * Gets the node immediately following this node.
         * @access public
         * @return \System\Xml\XmlNode The next XmlNode. If there is no next node, null is returned.
         */
        public function nextSibling() {
            return new XmlAttribute($this->node->nextSibling);
        }

        /**
         * When overridden in a derived class, saves all the child nodes of the node to the specified System.Xml.XmlWriter.
         * @access public
         * @param XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeContentTo(XmlWriter $w)
        {
            // TODO: Implement writeContentTo() method.
        }

        /**
         * When overridden in a derived class, saves the current node to the specified System.Xml.XmlWriter.
         * @access public
         * @param XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeTo(XmlWriter $w)
        {
            // TODO: Implement writeTo() method.
        }
    }
}