<?php

namespace System\Xml {

	/**
	 * Enables a class to return an System.Xml.XmlNode from the current context or position.
	 * @access public
	 * @name IHasXmlNode
	 * @package System
	 * @subpackage Xml
	 */
	interface IHasXmlNode {

	    /**
	     * Returns the System.Xml.XmlNode for the current position.
	     * @abstract
	     * @return XmlNode The XmlNode for the current position.
	     */
	    function getNode();
	}
}
?>