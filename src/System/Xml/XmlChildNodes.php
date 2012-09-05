<?php

namespace System\Xml;

require_once("XmlNodeList.php");


final class XmlChildNodes extends \System\Xml\XmlNodeList {

    private $nodeList;

    public function __construct(\DOMNodeList $nodeList) {
        $this->nodeList = $nodeList;
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
     * Retrieves a node at the given index.
     * @param $index Zero-based index into the list of nodes.
     * @return XmlNode The XmlNode in the collection.If index is greater than or equal to the number of nodes in the list, this returns Nothing.
     */
    public function Item($index) {
        
    }

    /**
     * Gets the number of nodes in the XmlNodeList.
     * @access public
     * @return int The number of nodes.
     */
    public function count() {
        return $this->nodeList->length;
    }
}
