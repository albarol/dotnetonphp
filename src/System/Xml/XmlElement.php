<?php

namespace System\Xml {


    use \System\Xml\XmlChildNodes as XmlChildNodes;
    use \System\Xml\XmlDocument as XmlDocument;
    use \System\Xml\XmlLinkedNode as XmlLinkedNode;
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
         * Returns an XmlNodeList containing a list of all descendant elements that match the specified Name.
         * @access public
         * @param string $name The name tag to match.This is a qualified name.It is matched against the Name property of the matching node.The asterisk (*) is a special value that matches all tags.
         * @return \System\Xml\XmlNodeList An XmlNodeList containing a list of all matching nodes.
        */
        public function getElementsByTagName($name) {
            $elements = $this->element->getelementsByTagName($name);
            return ($elements->length > 0) ? new XmlChildNodes($elements) : null;
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
         * @throws \System\InvalidOperationException Calling this method on a node type that cannot be cloned.
         * @param $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
         * @return XmlNode The cloned node.
         */
        public function cloneNode($deep) {
            $cloned = $this->element->cloneNode($deep);
            return new XmlElement($cloned);
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
            return XmlNodeType::element();
        }


        /**
         * Removes all specified attributes from the element. Default attributes are not removed.
         * @access public
         * @return void
        */
        public function removeAllAttributes() {
            $size = $this->attributes()->count();
            for($i = 0; $i < $size; $i++):
                $attr = $this->attributes()->item(0);
                $this->removeAttribute($attr->name());
            endfor;
        }

        /**
         * Removes an attribute by name.
         * @access public
         * @throws \System\ArgumentException The node is read-only.
         * @param string $name The name of the attribute to remove.This is a qualified name.It is matched against the Name property of the matching node.
         * @return void
        */
        public function removeAttribute($name) {
            $this->node->removeAttribute($name);
            $this->namedNodeMap = null;
        }

        /**
         * Removes the attribute node with the specified index from the element.(If the removed attribute has a default value, it is immediately replaced).
         * @access public
         * @param $int i The index of the node to remove.The first node has index 0.
         * @return \System\Xml\XmlNode The attribute node removed or null if there is no node at the given index.
        */
        public function removeAttributeAt($i) {
            $node = $this->attributes()->item($i);
            if(!isset($node)) {
                return null;
            }

            $this->node->removeAttribute($node->name());
            $this->namedNodeMap = null;
            return $node;
        }

        /**
         * Removes the specified XmlAttribute.
         * @access public
         * @param \System\Xml\XmlAttribute The XmlAttribute node to remove.If the removed attribute has a default value, it is immediately replaced.
         * @return \System\Xml\XmlAttribute The removed XmlAttribute or null if oldAttr is not an attribute node of the XmlElement.
        */
        public function removeAttributeNode(XmlAttribute $oldAttr) {
            $this->removeAttribute($oldAttr->name());
            return $oldAttr;
        }

        /**
         * Sets the value of the attribute with the specified name.
         * @access public
         * @param string $name The name of the attribute to create or alter.This is a qualified name.If the name contains a colon it is parsed into prefix and local name components.
         * @param string $value The value to set for the attribute. 
         * @return void
        */
        public function setAttribute($name, $value) {
            $this->node->setAttribute($name, $value);
            $this->namedNodeMap = null;
        }

        /**
         * Adds the specified XmlAttribute.
         * @access public
         * @param \System\Xml\XmlAttribute $newAttr The XmlAttribute node to add to the attribute collection for this element. 
         * @return \System\Xml\XmlAttribute If the attribute replaces an existing attribute with the same name, the old XmlAttribute is returned; otherwise, null is returned.
        */
        public function setAttributeNode(XmlAttribute $newAttr) {
            $this->setAttribute($newAttr->name(), $newAttr->value());
            $oldAttr = $this->node->getAttributeNode($newAttr->name());
            return is_null($oldAttr) ? null : new XmlAttribute($oldAttr);
        }

        /**
         * Overridden. Saves all the child nodes of the node to the specified System.Xml.XmlWriter.
         * @access public
         * @param \System\Xml\XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeContentTo(XmlWriter $w) { 
            // TODO: Implement writeContentTo() method.
        }

        /**
         * Overridden. Saves the current node to the specified System.Xml.XmlWriter.
         * @access public
         * @param \System\Xml\XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public function writeTo(XmlWriter $w) { 
            // TODO: Implement writeTo() method.
        }
    }
}