<?php

namespace System\Xml {

    use \System\Xml\XmlNode as XmlNode;

    /**
     * Gets the node immediately preceding or following this node.
     * @access public
     * @name XmlLinkedNode
     * @package System
     * @subpackage Xml
     */
    abstract class XmlLinkedNode extends XmlNode {

        
        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        protected function __construct(\DOMNode $node) {
            parent::__construct($node);
        }

        /**
         * Gets the node immediately following this node.
         * @access public
         * @return XmlNode The System.Xml.XmlNode immediately following this node or null if one does not exist.
         */
        public function nextSibling() {
            
        }

        /**
         * Gets the node immediately preceding this node.
         * @access public
         * @return XmlNode The preceding System.Xml.XmlNode or null if one does not exist.
         */
        public function previousSibling() {

        }

    }
}