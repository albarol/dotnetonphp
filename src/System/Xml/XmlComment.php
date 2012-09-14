<?php

namespace System\Xml {

	use \System\Xml\XmlCharacterData as XmlCharacterData;    

	/**
	 * Represents the content of an XML comment.
	 * @access public
	 * @name XmlComment
	 * @package System
	 * @subpackage Xml
	 */
	class XmlComment extends XmlCharacterData {

		/**
		* This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
		* @access private
		*/
		public function __construct(\DOMComment $comment) {
			parent::__construct($comment);
		}

	}

}