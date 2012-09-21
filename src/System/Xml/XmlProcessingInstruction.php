<?php


namespace System\Xml {

    use \System\Xml\XmlLinkedNode as XmlLinkedNode;

    /**
     * Represents a processing instruction, which XML defines to keep processor-specific information in the text of the document.
     * @access public
     * @name XmlProcessingInstruction 
     * @package System
     * @subpackage Xml
     */
    class XmlProcessingInstruction  extends XmlLinkedNode {

        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        public function __construct(\DOMProcessingInstruction $instruction) {
            parent::__construct($instruction);
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
         * The IXPathNavigable type exposes the following members.
         * @access public
         * @return IXPathNavigable Returns a new XPathNavigator object.
         */
        public function createNavigator() {
            // TODO: Implement createNavigator() method.
        }

        /**
         *  Overridden. Gets the local name of the current node.
         * @access public
         * @return string The name of the node with the prefix removed. For example, LocalName is book for the element 
         */
        public function localName() {

        }

        /**
         * Overridden. Gets the qualified name of the node.
         * @access public
         * @return string The qualified name of the node. The name returned is dependent on the System.Xml.XmlNode.NodeType of the node
         */
        public function name() {
            return "";
        }

        /**
         * Overridden. Gets the type of the current node.
         * @access public
         * @return \System\Xml\XmlNodeType One of the System.Xml.XmlNodeType values.
         */
        public function nodeType() { 
            return XmlNodeType::processingInstruction();
        }

        /**
         * Overridden. Saves all the child nodes of the node to the specified System.Xml.XmlWriter.
         * @access public
         * @param XmlWriter $w The XmlWriter to which you want to save. 
         * @return void
         */
        public function writeContentTo(XmlWriter $w) { }

        /**
         * Overridden. Saves the current node to the specified System.Xml.XmlWriter.
         * @access public
         * @param XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeTo(XmlWriter $w) { }
    }
}