<?php

namespace System\Xml { 

    use \System\Xml\XmlElement as XmlElement;
    use \System\Xml\XmlNodeList as XmlNodeList;

    final class XmlChildNodes extends XmlNodeList {

        private $nodeList;

        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
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
         * @return XmlNode The XmlNode in the collection.If index is greater than or equal to the number of nodes in the list, this returns null.
         */
        public function item($index) {
            $item = $this->nodeList->item($index);
            switch ($item->nodeType) {
                case XmlNodeType::Element;
                    return new XmlElement($item);
                case XmlNodeType::Text;
                    return new XmlText($item);
                default:
                    return null;
            }
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
}