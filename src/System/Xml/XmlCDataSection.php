<?php

namespace System\Xml {

	use \System\Xml\XmlCharacterData as XmlCharacterData;

	/**
     * Represents a CDATA section.
     * @access public
    */	
	class XmlCDataSection extends XmlCharacterData {


		/**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code.
        * @access private
        */
        public function __construct(\DOMCdataSection $node) {
            parent::__construct($node);
        }

       /**
         * Gets the markup representing this node and all its child nodes.
         * @access public
         * @return string The markup containing this node and all its child nodes. Note:OuterXml does not return default attributes.
         */
        public function outerXml() {
            return "<![CDATA[".$this->value()."]]>";
        }

	}
}