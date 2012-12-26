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
         * Gets or sets the content of the processing instruction, excluding the target.
         * @access public
         * @param string $value The content of the processing instruction, excluding the target.
         * @return string  The content of the processing instruction.
        */        
        public function data($value=null) {
            if (!is_null($value)) {
                $this->node->data = $value;
            }
            return $this->node->data;
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
         * Overridden. Gets the type of the current node.
         * @access public
         * @return \System\Xml\XmlNodeType One of the System.Xml.XmlNodeType values.
         */
        public function nodeType() { 
            return XmlNodeType::processingInstruction();
        }

        /**
         * Gets the target of the processing instruction. 
         * @access public
         * @return string Gets the target of the processing instruction. 
        */
        public function target() {
            return $this->node->target;
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