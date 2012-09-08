<?php

namespace System\Xml {


    use \System\Xml\XmlLinkedNode as XmlLinkedNode;
    use \System\Xml\XmlNodeType as XmlNodeType;

    /**
     * Provides text manipulation methods that are used by several classes.
     * @access public
     * @name XmlCharacterData
     * @package System
     * @subpackage Xml
     */
    class XmlCharacterData extends XmlLinkedNode {

        protected $characterData;

        /**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        public function __construct(\DOMCharacterData $characterData) {
            parent::__construct($characterData);
            $this->characterData = $characterData;
        }

        /**
         * Contains the data of the node.
         * @access public
         * @param string $value The data of the node.
         * @return string The data returned is equivalent to the Value property.  
        */
        public function data($value=null) {
            if(!is_null($value)) {
                $this->node->value($value);
            }
            return $this->node->value();
        }
    }
}