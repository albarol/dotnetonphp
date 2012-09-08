<?php

namespace System\Xml {


    use \System\ICloneable as ICloneable;
    
    use \System\Collections\IEnumerable as IEnumerable;
    
    use \System\Xml\XmlAttributeCollection as XmlAttributeCollection;
    use \System\Xml\XmlChildNodes as XmlChildNodes;
    use \System\Xml\XmlNodeList as XmlNodeList;
    use \System\Xml\XmlNodeType as XmlNodeType;
    use \System\Xml\XPath\IXPathNavigable as IXPathNavigable;

    /**
     * Represents a single node in the XML document.
     * @access public
     * @name XmlNode
     * @package System
     * @subpackage Xml
     */
    abstract class XmlNode implements ICloneable, IEnumerable, IXPathNavigable {

        protected $node;
        protected $namedNodeMap;
        protected $childNodes;
        protected $ownerDocument;

        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        protected function __construct(\DomNode $node) {
            $this->node = $node;
        }

        /**
         * Gets an XmlAttributeCollection containing the attributes of this node.
         * @access public
         * @return \System\Xml\XmlAttributeCollection An XmlAttributeCollection containing the attributes of the node. If the node is of type XmlNodeType.Element, the attributes of the node are returned. Otherwise, this property returns null.
         */
        public function attributes() {
            if(!isset($this->namedNodeMap)) {
                $this->namedNodeMap = new XmlAttributeCollection($this->node->attributes);
            }
            return $this->namedNodeMap;
        }

        /**
         * Gets the base URI of the current node.
         * @access public
         * @return string The location from which the node was loaded or String.Empty if the node has no base URI.
         */
        public function baseUri() {
            return $this->node->baseURI;
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
            //$this->node->appendChild()
        }

        /**
         * Gets all the child nodes of the node.
         * @access public
         * @return \System\Xml\XmlNodeList An XmlNodeList that contains all the child nodes of the node. If there are no child nodes, this property returns an empty System.Xml.XmlNodeList.
         */
        public function childNodes() {
            if(!isset($this->childNodes)) {
                $this->childNodes = new XmlChildNodes($this->node->childNodes);
            }
            return $this->childNodes;
        }

        /**
         * When overridden in a derived class, creates a duplicate of the node.
         * @access public
         * @abstract
         * @throws \System\InvalidOperationException
         * @param bool $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
         * @return XmlNode The cloned node.
         */
        public abstract function cloneNode($deep);


        /**
         * Creates a new object that is a copy of the current instance.
         * @access public
         * @return Object A new object that is a copy of this instance.
         */
        public function cloneObject() {
            return clone $this;
        }


        /**
         * Gets the first child of the node.
         * @access public
         * @return \System\Xml\XmlNode The first child of the node. If there is no such node, null is returned.
         */
        public function firstChild() {
            $childNodes = $this->childNodes();
            return $childNodes->item(0);
        }

        /**
         * Gets the first child element with the specified System.Xml.XmlNode.Name.
         * @param $name The qualified name of the element to retrieve.
         * @return \System\Xml\XmlElement The first System.Xml.XmlElement that matches the specified name.
         */
        public function get($name) {
            
        }


         /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return \System\Collections\IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            
        }


        /**
         * Looks up the closest xmlns declaration for the given prefix that is in scope for the current node and returns the namespace URI in the declaration.
         * @access public
         * @param string $prefix Prefix whose namespace URI you want to find.
         * @return string The namespace URI of the specified prefix.
         */
        public function getNamespaceOfPrefix($prefix) {
            
        }

        /**
         * Looks up the closest xmlns declaration for the given namespace URI that is in scope for the current node and returns the prefix defined in that declaration.
         * @access public
         * @param string $namespaceUri Namespace URI whose prefix you want to find.
         * @return string The prefix for the specified namespace URI.
         */
        public function getPrefixOfNamespace($namespaceUri) {
            
        }

        /**
         * Gets a value indicating whether this node has any child nodes.
         * @access public
         * @return bool true if the node has child nodes; otherwise, false.
         */
        public function hasChildNodes() {
            return $this->node->hasChildNodes();
        }

        /**
         * Gets or sets the concatenated values of the node and all its child nodes.
         * @access public
         * @return string The concatenated values of the node and all its child nodes.
         */
        public function innerText() {
            return $this->node->nodeValue;
        }

        /**
         * Gets or sets the markup representing only the child nodes of this node.
         * @access public
         * @throws \System\InvalidOperationException Setting this property on a node that cannot have child nodes. 
         * @throws \System\Xml\XmlException The XML specified when setting this property is not well-formed. 
         * @return string The markup of the child nodes of this node. Note:InnerXml does not return default attributes.
         */
        public function innerXml() {
            $document = new \DOMDocument();
            $document->appendChild($document->importNode($this->node, TRUE));
            $xml = trim($document->saveHTML());
            $tag = $this->name();
            return preg_replace('@^<' . $tag . '[^>]*>|</' . $tag . '>$@', '', $xml);
        }

        /**
         * Inserts the specified node immediately after the specified reference node.
         * @access public
         * @throws InvalidOperationException|ArgumentException
         * @param \System\Xml\XmlNode $newChild The XmlNode to insert.
         * @param \System\Xml\XmlNode $refChild The XmlNode that is the reference node. The newNode is placed after the refNode.
         * @return \System\Xml\XmlNode The node being inserted.
         */
        public function insertAfter(XmlNode $newChild, XmlNode $refChild) {
            
        }

        /**
         * Inserts the specified node immediately before the specified reference node.
         * @access public
         * @throws InvalidOperationException|ArgumentException
         * @param \System\Xml\XmlNode $newChild The XmlNode to insert.
         * @param \System\Xml\XmlNode $refChild The XmlNode that is the reference node.  The newChild is placed before this node.
         * @return \System\Xml\XmlNode The node being inserted.
         */
        public function insertBefore(XmlNode $newChild, XmlNode$refChild) {

        }

        /**
         * Gets a value indicating whether the node is read-only.
         * @access public
         * @return bool true if the node is read-only; otherwise false.
         */
        public function isReadOnly() {

        }

        /**
         * Gets the last child of the node.
         * @access public
         * @return \System\Xml\XmlNode The last child of the node. If there is no such node, null is returned.
         */
        public function lastChild() {
            $childNodes = $this->childNodes();
            return $childNodes->item($childNodes->count() - 1);
        }


        /**
         * When overridden in a derived class, gets the local name of the node.
         * @access public
         * @abstract
         * @return string The name of the node with the prefix removed. For example, LocalName is book for the element 
         */
        public abstract function localName();



        /**
         * When overridden in a derived class, gets the qualified name of the node.
         * @access public
         * @abstract
         * @return string The qualified name of the node. The name returned is dependent on the System.Xml.XmlNode.NodeType of the node
         */
        public abstract function name();


        /**
         * Gets the namespace URI of this node.
         * @access public
         * @return string The namespace URI of this node. If there is no namespace URI, this property returns String.Empty.
         */
        public function namespaceURI() {
            return $this->node->namespaceURI;
        }

        /**
         * Gets the node immediately following this node.
         * @access public
         * @return \System\Xml\XmlNode The next XmlNode. If there is no next node, null is returned.
         */
        public function nextSibling() { 
            return null;
        }

        /**
         * When overridden in a derived class, gets the type of the current node.
         * @access public
         * @abstract
         * @return \System\Xml\XmlNodeType One of the System.Xml.XmlNodeType values.
         */
        public abstract function nodeType();


        /**
         * Puts all XmlText nodes in the full depth of the sub-tree underneath this XmlNode into a "normal" form where only markup (that is, tags, comments, processing instructions, CDATA sections, and entity references) separates XmlText nodes, that is, there are no adjacent XmlText nodes.
         * @access public
         * @return void
         */
        public function normalize() {

        }

        /**
         * Gets the markup representing this node and all its child nodes.
         * @access public
         * @return string The markup containing this node and all its child nodes. Note:OuterXml does not return default attributes.
         */
        public function outerXml() {
            $document = new \DOMDocument();
            $document->appendChild($document->importNode($this->node, TRUE));
            $xml = trim($document->saveHTML());
            return $xml;
        }

        /**
         * Gets the System.Xml.XmlDocument to which this node belongs.
         * @access public
         * @return \System\Xml\XmlDocument The System.Xml.XmlDocument to which this node belongs.  If the node is an System.Xml.XmlDocument (NodeType equals XmlNodeType.Document), this property returns null.
         */
        public function ownerDocument() {

        }

        /**
         * Gets the parent of this node (for nodes that can have parents).
         * @access public
         * @return \System\Xml\XmlNode The XmlNode that is the parent of the current node. If a node has just been created and not yet added to the tree, or if it has been removed from the tree, the parent is null. For all other nodes, the value returned depends on the System.Xml.XmlNode.NodeType of the node. The following table describes the possible return values for the ParentNode property.
         */
        public function parentNode() { 
            $nodeType = $this->node->parentNode->nodeType;
            switch ($nodeType) {
                case XmlNodeType::Document:
                    return $this->ownerDocument();
                default:
                    return new XmlElement($this->node->parentNode);
            }
        }


        /**
         * Gets or sets the namespace prefix of this node.
         * @access public
         * @throws \System\ArgumentException This node is read-only. 
         * @throws \System\Xml\XmlException he specified prefix contains an invalid character. -or- The specified prefix is malformed. -or- The specified prefix is "xml" and the namespaceURI of this node is different from "http://www.w3.org/XML/1998/namespace". -or- This node is an attribute and the specified prefix is "xmlns" and the namespaceURI of this node is different from "http://www.w3.org/2000/xmlns/ ". -or- This node is an attribute and the qualifiedName of this node is "xmlns". 
         * @param string $value The namespace prefix of this node.
         * @return string The namespace prefix of this node. For example, Prefix is bk for the element <bk:book>. If there is no prefix, this property returns String.Empty.
         */
        public function prefix($value=null) { 
            if(!is_null($value)) {

            }
            return $this->node->prefix;
        }


        /**
         * Adds the specified node to the beginning of the list of child nodes for this node.
         * @access public
         * @throws \System\InvalidOperationException
         * @throws \System\ArgumentException
         * @param \System\Xml\XmlNode $newChild The node to add. All the contents of the node to be added are moved into the specified location.
         * @return \System\Xml\XmlNode The node added.
         */
        public function prependChild(XmlNode $newChild) {
            
        }

        /**
         * Gets the node immediately preceding this node.
         * @access public
         * @return \System\Xml\XmlNode The preceding XmlNode. If there is no preceding node, null is returned.
         */
        public function previousSibling() {  
            return null;
        }

        /**
         * Gets the post schema validation infoset that has been assigned to this node as a result of schema validation.
         * @access public
         * @return \System\Xml\IXmlSchemaInfo An System.Xml.Schema.IXmlSchemaInfo object containing the post schema validation infoset of this node
         */
        public function schemaInfo() { }


        /**
         * Removes all the child nodes and/or attributes of the current node.
         * @access public
         * @return void
         */
        public function removeAll() {

        }

        /**
         * Removes specified child node.
         * @access public
         * @throws ArgumentException
         * @param \System\Xml\XmlNode $oldChild The node being removed. 
         * @return \System\Xml\XmlNode The node removed.
         */
        public function removeChild(XmlNode $oldChild) {
            
        }

        /**
         * Replaces the child node oldChild with newChild node.
         * @access public
         * @throws InvalidOperationException|ArgumentException
         * @param \System\Xml\XmlNode $newChild The new node to put in the child list.
         * @param \System\Xml\XmlNode $oldChild The node being replaced in the list.
         * @return \System\Xml\XmlNode The node replaced.
         */
        public function replaceChild(XmlNode $newChild, XmlNode $oldChild) {
            
        }

        /**
         * Selects a list of nodes matching the XPath expression. Any prefixes found in the XPath expression are resolved using the supplied System.Xml.XmlNamespaceManager.
         * @access public
         * @throws \System\Xml\XPath\XPathException
         * @param string $xpath The XPath expression. 
         * @param \System\Xml\XmlNamespaceManager $nsmgr An System.Xml.XmlNamespaceManager to use for resolving namespaces for prefixes in the XPath expression.
         * @return \System\Xml\XmlNodeList An System.Xml.XmlNodeList containing a collection of nodes matching the XPath query. The XmlNodeList should not be expected to be connected "live" to the XML document. That is, changes that appear in the XML document may not appear in the XmlNodeList, and vice versa.
         */
        public function selectNodes($xpath, $nsmgr=null) {
            
        }

        /**
         * Selects the first XmlNode that matches the XPath expression. Any prefixes found in the XPath expression are resolved using the supplied System.Xml.XmlNamespaceManager.
         * @access public
         * @throws \System\Xml\XPath\XPathException
         * @param $xpath The XPath expression.
         * @param null $nsmgr An System.Xml.XmlNamespaceManager to use for resolving namespaces for prefixes in the XPath expression.
         * @return XmlNode The first XmlNode that matches the XPath query or null if no matching node is found. The XmlNode should not be expected to be connected "live" to the XML document. That is, changes that appear in the XML document may not appear in the XmlNode, and vice versa.
         */
        public function selectSingleNode($xpath, $nsmgr=null) {
            
        }

        /**
         * Test if the DOM implementation implements a specific feature.
         * @access public
         * @param $feature The package name of the feature to test. This name is not case-sensitive. 
         * @param $version This is the version number of the package name to test. If the version is not specified (null), supporting any version of the feature causes the method to return true.
         * @return bool true if the feature is implemented in the specified version; otherwise, false. The following table describes the combinations that return true.
         */
        public function supports($feature, $version) {

        }


        /**
         * Gets or sets the value of the node.
         * @access public
         * @throws \System\ArgumentException Setting the value of a node that is read-only. 
         * @throws \System\InvalidOperationException Setting the value of a node that is not supposed to have a value (for example, an Element node).
         * @param $value Gets or sets the value of the node.
         * @return void The value returned depends on the NodeType of the node:  
         */
        public function value($value=null) {
            if (!is_null($value)) {
                $this->node->nodeValue = $value;
            }
            return $this->node->nodeValue;
        }

        /**
         * When overridden in a derived class, saves all the child nodes of the node to the specified System.Xml.XmlWriter.
         * @access public
         * @abstract
         * @param \System\Xml\XmlWriter $w The XmlWriter to which you want to save. 
         * @return void
         */
        public abstract function writeContentTo(XmlWriter $w);

        /**
         * When overridden in a derived class, saves the current node to the specified System.Xml.XmlWriter.
         * @access public
         * @abstract
         * @param \System\Xml\XmlWriter $w The XmlWriter to which you want to save.
         * @return void
         */
        public abstract function writeTo(XmlWriter $w);
    }
}