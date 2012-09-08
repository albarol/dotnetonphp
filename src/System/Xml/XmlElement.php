<?php

namespace System\Xml {


    use \System\Xml\XmlLinkedNode as XmlLinkedNode;
    use \System\Xml\XmlDocument as XmlDocument;
    use \System\Xml\XmlNodeType as XmlNodeType;

    /**
     * Represents an element.
     * @access public
     * @name XmlElement
     * @package System
     * @subpackage Xml
     */
    class XmlElement extends XmlLinkedNode {

        private $element;

        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        public function __construct(\DOMElement $element) {
            parent::__construct($element);
            $this->element = $element;
        }


        /**
         * Creates a new object that is a copy of the current instance.
         * @access public
         * @return Object A new object that is a copy of this instance.
         */
        public function cloneObject() {
            return clone $this;
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            // TODO: Implement getEnumerator() method.
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
         * Overridden. Creates a duplicate of the node.
         * @access public
         * @throws InvalidOperationException
         * @param $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
         * @return XmlNode The cloned node.
         */
        public function cloneNode($deep) {
            // TODO: Implement cloneNode() method.
        }


        /**
         * Gets a boolean value indicating whether the current node has any attributes.
         * @access public
         * @return bool true if the current node has attributes; otherwise, false. 
        */
        public function hasAttributes() {
            return $this->node->hasAttributes();
        }

        /**
         * Gets the first child element with the specified Name.
         * @access public
         * @param string $name The qualified name of the element to retrieve. 
         * @return \System\Xml\XmlElement The first XmlElement that matches the specified name.
        */
        public function item($name) {
            $elements = $this->element->getElementsByTagName($name);
            return ($elements->length) ? new XmlElement($elements->item(0)) : null;
        }

       
        /**
         *  Overridden. Gets the local name of the current node.
         * @access public
         * @return string The name of the node with the prefix removed. For example, LocalName is book for the element 
         */
        public function localName() {
            return $this->node->localName;
        }

        /**
         * Overridden. Gets the qualified name of the node.
         * @access public
         * @return string The qualified name of the node. The name returned is dependent on the System.Xml.XmlNode.NodeType of the node
         */
        public function name() {
            return $this->node->nodeName;
        }

        /**
         * Gets the node immediately following this node.
         * @access public
         * @return \System\Xml\XmlNode The next XmlNode. If there is no next node, null is returned.
         */
        public function nextSibling() {
            return new XmlElement($this->node->nextSibling);
        }

        /**
         * Overridden. Gets the type of the current node.
         * @access public
         * @return \System\Xml\XmlNodeType One of the System.Xml.XmlNodeType values.
         */
        public function nodeType() { 
            return XmlNodeType::Element;
        }

        /**
         * Gets the node immediately preceding this node.
         * @access public
         * @return XmlNode The preceding XmlNode. If there is no preceding node, null is returned.
         */
        public function previousSibling() {  
            return new XmlElement($this->node->previousSibling);
        }


        /**
         * Overridden. Saves all the child nodes of the node to the specified System.Xml.XmlWriter.
         * @access public
         * @param \System\Xml\XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeContentTo(XmlWriter $w) { }

        /**
         * Overridden. Saves the current node to the specified System.Xml.XmlWriter.
         * @access public
         * @param \System\Xml\XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeTo(XmlWriter $w) { }
    }
}