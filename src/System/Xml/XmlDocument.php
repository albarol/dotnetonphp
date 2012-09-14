<?php

namespace System\Xml {

    use \System\Xml\XmlAttribute as XmlAttribute;
    use \System\Xml\XmlCDataSection as XmlCDataSection;
    use \System\Xml\XmlChildNodes as XmlChildNodes;
    use \System\Xml\XmlComment as XmlComment;
    use \System\Xml\XmlException as XmlException;
    use \System\Xml\XmlNode as XmlNode;
    use \System\Xml\XmlNodeType as XmlNodeType;
    use \System\Xml\XmlReader as XmlReader;
    
    use \System\IO\TextReader as TextReader;
    use \System\IO\Stream as Stream;

    /**
     * Represents an XML document.
     * @access public
     * @name XmlDocument
     * @package System
     * @subpackage Xml
     */
    class XmlDocument extends XmlNode {

        private $document;

        /**
         * Initializes a new instance of the XmlDocument class.
         * @access public
        */
        public function __construct() { 
            $this->document = new \DOMDocument();
            parent::__construct($this->document);
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
            $doc = new \DOMDocument();
            $doc->loadXML($newChild->outerXml());
            $newNode = $this->node->importNode($doc->documentElement, TRUE);
            $this->node->appendChild($newNode);
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
         * @return \System\Collections\IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            // TODO: Implement getEnumerator() method.
        }

        /**
         * Creates an XmlAttribute with the specified name, namespaceURI and prefix
         * @access public
         * @param string $name The local name of the new attribute. -or- The qualified name of the attribute.
         * @param string $namespaceURI The namespace URI of the new attribute (if any). String.Empty and null are equivalent.
         * @param string $prefix The prefix of the new attribute (if any). String.Empty and null are equivalent.
         * @return \System\Xml\XmlAttribute The new XmlAttribute.
        */
        public function createAttribute($name, $namespaceURI=null, $prefix=null) {
            $attr = null;
            if (is_null($namespaceURI) && is_null($prefix)) {
                $attr = $this->document->createAttribute($name);
            } else {
                $attr = $this->document->createAttributeNS($namespaceURI, $prefix.':'.$name);
            }
            return new XmlAttribute($attr);
        }

        /**
         * Creates an XmlCDataSection containing the specified data.
         * @access public
         * @param string $data The content of the new XmlCDataSection.
         * @return \System\Xml\XmlCDataSection The new XmlCDataSection.
         */
        public function createCDataSection($data) {
            $cdata = $this->document->createCDATASection($data);
            return new XmlCDataSection($cdata);
        }

        /**
        * Creates an XmlComment containing the specified data.
        * @access public
        * @param string $data The content of the new XmlComment.
        * @return \System\Xml\XmlComment The new XmlComment.
        */
        public function createComment($data) {
            $comment = $this->document->createComment($data);
            return new XmlComment($comment);
        }

        /**
         * Creates an XmlElement with the specified name, namespaceURI and prefix
         * @access public
         * @param string $name The local name of the new element. -or- The qualified name of the element.
         * @param string $namespaceURI The namespace URI of the new element (if any). String.Empty and null are equivalent.
         * @param string $prefix The prefix of the new element (if any). String.Empty and null are equivalent.
         * @return \System\Xml\XmlElement The new XmlAttribute.
        */
        public function createElement($name, $namespaceURI=null, $prefix=null) {
            $element = null;
            if (is_null($namespaceURI) && is_null($prefix)) {
                $element = $this->document->createElement($name);
            } else {
                $element = $this->document->createElementNS($namespaceURI, $prefix.':'.$name);
            }
            return new XmlElement($element);
        }

        /**
         * The IXPathNavigable type exposes the following members.
         * @access public
         * @return IXPathNavigable Returns a new XPathNavigator object.
         */
        public function createNavigator()
        {
            // TODO: Implement createNavigator() method.
        }

        /**
         * When overridden in a derived class, creates a duplicate of the node.
         * @access public
         * @throws InvalidOperationException
         * @param $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
         * @return XmlNode The cloned node.
         */
        public function cloneNode($deep) {
            // TODO: Implement cloneNode() method.
        }


        /**
         * Loads the XML document from the specified resource.
         * @access public
         * @throws XmlException
         * @param $value The resource containing the XML document to load.
         * @return void
         */
        public function load($value) {
            if($value instanceof XmlReader) {
                $this->createFromXmlReader($value);
            } else if($value instanceof TextReader) {
                $this->createFromTextReader($value);
            } else if($value instanceof Stream) {
                $this->createFromStream($value);
            } else {
                $this->createFromString($value);
            }
        }

        private function createFromXmlReader(XmlReader $reader) {
            $this->loadXml($reader->readOuterXml());
        }

        private function createFromTextReader(TextReader $reader) {
            $this->loadXml($reader->readToEnd());
        }

        private function createFromStream(Stream $stream) {
            $content = array();
            for($i = 0; $i < $stream->length(); $i++)
                array_push($content, $stream->readByte());
            $this->loadXml(implode($content));
        }

        private function createFromString($fileName) {
            $this->loadXml(file_get_contents($fileName));
        }


        # Create XmlElement
        # Create XmlChildNodes
        # Create XmlAttributes
        # Create XmlComments

        /**
         * Loads the XML document from the specified string.
         * @access public
         * @throws \Ssytem\Xml\XmlException There is a load or parse error in the XML. In this case, the document remains empty.
         * @param string $xml String containing the XML document to load.
         * @return void
         */
        public function loadXml($xml) {
            try {
                $this->document->loadXml($xml);
            } catch(\Exception $e) {
                throw new XmlException("There is a load or parse error in the XML. In this case, the document remains empty.");
            }
        }


        private function createNodes($parent, $node) {
            if($node->count() == 0) return;
            if($node instanceof \SimpleXMLElement) {
                
            }
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
         * @return \System\Xml\XmlNodeType One of the System.Xml.XmlNodeType values.
         */
        public function nodeType() {
            return XmlNodeType::document();
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
?>
