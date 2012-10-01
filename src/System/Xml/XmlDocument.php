<?php

namespace System\Xml {

    use \System\ArgumentException as ArgumentException;

    use \System\Xml\XmlAttribute as XmlAttribute;
    use \System\Xml\XmlCDataSection as XmlCDataSection;
    use \System\Xml\XmlChildNodes as XmlChildNodes;
    use \System\Xml\XmlComment as XmlComment;
    use \System\Xml\XmlDeclaration as XmlDeclaration;
    use \System\Xml\XmlException as XmlException;
    use \System\Xml\XmlNode as XmlNode;
    use \System\Xml\XmlNodeType as XmlNodeType;
    use \System\Xml\XmlProcessingInstruction as XmlProcessingInstruction;
    use \System\Xml\XmlSignificantWhitespace as XmlSignificantWhitespace;
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
        public function __construct(\DOMDocument $document=null) { 
            if (is_null($document)):
                $this->document = new \DOMDocument();
            else:
                $this->document = $document;
            endif;
            $this->preserveWhitespace(false);
            parent::__construct($this->document);
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
        * Creates an XmlDocumentFragment.
        * @access public
        * @return \System\Xml\XmlDocumentFragment The new XmlDocumentFragment.
        */
        public function createDocumentFragment() {
            $fragment = $this->document->createDocumentFragment();
            return new XmlDocumentFragment($fragment);
        }

        /**
        * Returns a new XmlDocumentType object. 
        * @access public
        * @param string $name Name of the document type. 
        * @param string $publicId The public identifier of the document type or a null reference (Nothing in Visual Basic). You can specify a public URI and also a system identifier to identify the location of the external DTD subset.
        * @param string $systemId The system identifier of the document type or a null reference (Nothing in Visual Basic). Specifies the URL of the file location for the external DTD subset.
        * @param string $internalSubset The DTD internal subset of the document type or a null reference (Nothing in Visual Basic). 
        * @return \System\Xml\XmlDocumentType The new XmlDocumentType.
        */
        public function createDocumentType($name, $publicId, $systemId, $internalSubset) {
            
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
        * Creates an XmlEntityReference with the specified name. 
        * @access public
        * @param string $name The name of the entity reference.
        * @return \System\Xml\XmlEntityReference The new XmlEntityReference.
        */
        public function createEntityReference($name) {
            $entity = $this->document->createEntityReference($name);
            return new XmlEntityReference($entity);
        }

        /**
        * Creates an XmlProcessingInstruction with the specified name and data.
        * @access public
        * @param string $target The name of the processing instruction.
        * @param string $data The data for the processing instruction.
        * @return \System\Xml\XmlProcessingInstruction The new XmlProcessingInstruction.
        */
        public function createProcessingInstruction($target, $data) {
            $instruction = $this->document->createProcessingInstruction($target, $data);
            return new XmlProcessingInstruction($instruction);
        }

        /**
        * Creates an XmlSignificantWhitespace node.
        * @access public
        * @throws \System\ArgumentException The text contains invalid characters. 
        * @param string $text The string must contain only the following characters &#20; &#10; &#13; and &#9; 
        * @return \System\Xml\XmlSignificantWhitespace A new XmlSignificantWhitespace node. 
        */
        public function createSignificantWhitespace($text) {
            if (strlen(trim($text)) > 0) {
                throw new ArgumentException("The text contains invalid characters.");
            }
            $whitespace = $this->document->createTextNode($text);
            return new XmlSignificantWhitespace($whitespace);
        }

        /**
        * Creates an XmlText with the specified text.
        * @access public
        * @param string $text The text for the Text node.
        * @return \System\Xml\XmlText The new XmlText node.
        */
        public function createTextNode($text) {
            $textNode = $this->document->createTextNode($text);
            return new XmlText($textNode);
        }

        /**
        * Creates an XmlWhitespace node.
        * @access public
        * @param string $text The string must contain only the following characters &#20; &#10; &#13; and &#9; 
        * @return \System\Xml\XmlWhitespace A new XmlWhitespace node. 
        */
        public function createWhitespace($text) {
            if (strlen(trim($text)) > 0) {
                throw new ArgumentException("The text contains invalid characters.");
            }
            $whitespace = $this->document->createTextNode($text);
            return new XmlWhitespace($whitespace);
        }

        /**
         * Creates an XmlDeclaration node with the specified values.
         * @access public
         * @throws \System\ArgumentException The values of version or standalone are something other than the ones specified above. 
         * @param string $version The version must be "1.0".
         * @param string $encoding he value of the encoding attribute. This is the encoding that is used when you save the XmlDocument to a file or a stream; therefore, it must be set to a string supported by the Encoding class, otherwise Save fails. If this is a null reference (Nothing in Visual Basic) or String.Empty, the Save method does not write an encoding attribute on the XML declaration and therefore the default encoding, UTF-8, is used.
         * @param string The value must be either "yes" or "no". If this is a null reference (Nothing in Visual Basic) or String.Empty, the Save method does not write a standalone attribute on the XML declaration. 
         * @return \System\Xml\XmlDeclaration The new XmlDeclaration node.
        */
        public function createXmlDeclaration($version, $encoding, $standalone) {
            return new XmlDeclaration($version, $encoding, $standalone);
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
         * Gets the root XmlElement for the document.
         * @access public
         * @return \System\Xml\XmlElement Gets the root XmlElement for the document.
        */
        public function documentElement() {
            return is_null($this->document->documentElement) ? null : new XmlElement($this->document->documentElement);
        }

        /**
         * Gets the XmlElement with the specified ID.
         * @access public
         * @param string $elementId The attribute ID to match.
         * @return The XmlElement with the matching ID or a null reference if no matching element is found. 
        */
        public function getElementById($elementId) {
            $xpath = new \DOMXPath($this->document);
            $element = $xpath->query("//*[@id='$elementId']")->item(0);
            return isset($element) ? new XmlElement($element) : null;
        }

        /**
         * Returns an XmlNodeList containing a list of all descendant elements that match the specified Name.
         * @access public
         * @param string $name The qualified name to match. It is matched against the Name property of the matching node. The special value "*" matches all tags. 
         * @return \System\Xml\XmlNodeList An XmlNodeList containing a list of all matching nodes.
        */
        public function getElementsByTagName($name) {
            $elements = $this->document->getElementsByTagName($name);
            return new XmlChildNodes($elements);
        }

        /**
         * Imports a node from another document to the current document. 
         * @access public
         * @throws \System\InvalidOperationException Calling this method on a node type which cannot be imported.     
         * @param \System\Xml\XmlNode $node The node being imported. 
         * @param bool $deep true to perform a deep clone; otherwise, false.
         * @return \System\Xml\XmlNode The imported XmlNode.
        */
        public function importNode(XmlNode $node, $deep) {
            $newNode = $this->convertFrom($node, $deep);
            $imported = $this->ownerDocument->importNode($newNode, $deep);
            return $node;
        }


        /**
         * Loads the XML document from the specified resource.
         * @access public
         * @throws \System\Xml\XmlException
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

        /**
         * Loads the XML document from the specified string.
         * @access public
         * @throws \System\Xml\XmlException There is a load or parse error in the XML. In this case, the document remains empty.
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
            return XmlNodeType::document();
        }

        /**
         * Gets the markup representing this node and all its child nodes.
         * @access public
         * @return string The markup containing this node and all its child nodes. Note:OuterXml does not return default attributes.
         */
        public function outerXml() {
            $xml = trim($this->node->saveXML());
            return trim($this->replaceWhitespace($xml));
        }

        /**
         * Gets or sets a value indicating whether to preserve white space in element content.
         * @access public
         * @param bool $value true to preserve white space; otherwise false. The default is false.
         * @return bool true to preserve white space; otherwise false. The default is false. 
        */
        public function preserveWhitespace($value=null) {
            if (!is_null($value)):
                $this->document->preserveWhiteSpace = $value;
            endif;
            return $this->document->preserveWhiteSpace;
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
