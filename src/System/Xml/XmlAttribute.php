<?php

namespace System\Xml { 

    use \System\InvalidOperationException as InvalidOperationException;

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
        public function __construct(\DOMAttr $node) {
            parent::__construct($node);
        }


        /**
         * Adds the specified node to the end of the list of child nodes, of this node.
         * @access public
         * @throws \System\InvalidOperationException This node is of a type that does not allow child nodes of the type of the newChild node. -or- The newChild is an ancestor of this node. 
         * @throws \System\ArgumentException The newChild was created from a different document than the one that created this node. -or- This node is read-only. 
         * @param \System\Xml\XmlNode $newChild The node to add. All the contents of the node to be added are moved into the specified location.
         * @return void
         */
        public function appendChild(XmlNode $newChild) {
            if ($newChild->nodeType() != XmlNodeType::text()) {
                throw new InvalidOperationException("This node is of a type that does not allow child nodes of the type of the newChild node. -or- The newChild is an ancestor of this node.");
            }
            parent::appendChild($newChild);
        }

        /**
         * Overridden. Creates a duplicate of the node.
         * @access public
         * @throws \System\InvalidOperationException This node is of a type that does not allow child nodes of the type of the newChild node.
         * @param bool $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
         * @return \System\Xml\XmlNode The cloned node.
         */
        public function cloneNode($deep) {
            return $this->cloneObject();
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
            return XmlNodeType::attribute();
        }

        /**
         * Gets the markup representing this node and all its child nodes.
         * @access public
         * @return string The markup containing this node and all its child nodes. Note:OuterXml does not return default attributes.
         */
        public function outerXml() {
            return $this->name()."=".$this->value();
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