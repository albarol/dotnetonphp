<?php

namespace System\Xml {

	/**
	 * Defines the context for a set of XmlDocument objects.
	 * @access public
	 * @name XmlImplementation
	 * @package System
	 * @subpackage Xml
	 */
	class XmlImplementation {

		/**
		 * Initializes a new instance of the XmlImplementation class.
		 * @access public
		*/
		public function __construct() { }


		/**
		 * Creates a new XmlDocument.
		 * @access public
		 * @return \System\Xml\XmlDocument The new XmlDocument object.
		*/
		public function createDocument() { }


		/**
		 * Tests if the Document Object Model (DOM) implementation implements a specific feature.
		 * @access public
		 * @param string $strFeature The package name of the feature to test.This name is not case-sensitive.
		 * @param string $strVersion This is the version number of the package name to test.If the version is not specified (null), supporting any version of the feature causes the method to return true.
		 * @return bool true if the feature is implemented in the specified version; otherwise, false. The following table shows the combinations that cause HasFeature to return true.
		*/
		public function hasFeature($strFeature, $strVersion) { }

	}
}