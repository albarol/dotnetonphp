<?php

namespace System\Xml;

require_once("XmlException.php");
require_once("XmlNode.php");
require_once("XmlChildNodes.php");


class XmlDocument extends XmlNode {

    private $document;
    private $childNodes;

    public function __construct() { }

    /**
     * Gets all the child nodes of the node.
     * @access public
     * @return XmlNodeList
     */
    public function childNodes() {
        if($this->Node->hasChildNodes()) {
            $this->childNodes = new XmlChildNodes($this->Node->childNodes);
        } else {
            $this->childNodes = new XmlChildNodes(new \DOMNodeList());
        }
        return $this->childNodes;
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
    function getEnumerator()
    {
        // TODO: Implement getEnumerator() method.
    }

    /**
     * The IXPathNavigable type exposes the following members.
     * @access public
     * @return IXPathNavigable Returns a new XPathNavigator object.
     */
    function createNavigator()
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
        } else if($value instanceof \System\IO\TextReader) {
            $this->createFromTextReader($value);
        } else if($value instanceof \System\IO\Stream) {
            $this->createFromStream($value);
        } else {
            $this->createFromString($value);
        }
    }

    private function createFromXmlReader(XmlReader $reader) {
        $this->loadXml($reader->readOuterXml());
    }

    private function createFromTextReader(\System\IO\TextReader $reader) {
        $this->LoadXml($reader->readToEnd());
    }

    private function createFromStream(\System\IO\Stream $stream) {
        $content = array();
        for($i = 0; $i < $stream->length(); $i++)
            array_push($content, $stream->readByte());
        $this->loadXml(implode($content));
    }

    private function createFromString($fileName) {
        $this->LoadXml(file_get_contents($fileName));
    }


    /**
     * Loads the XML document from the specified string.
     * @access public
     * @throws XmlException
     * @param string $xml String containing the XML document to load.
     * @return void
     */
    public function loadXml($xml) {
        try {
            $document = simplexml_load_string($xml);
            $this->createNodes($document);
        } catch(\Exception $e) {
            throw new XmlException("There is a load or parse error in the XML. In this case, the document remains empty.");
        }
    }


    private function createNode($parent, $node) {
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
     * @return XmlNodeType One of the System.Xml.XmlNodeType values.
     */
    public function nodeType()
    {
        // TODO: Implement nodeType() method.
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
?>
