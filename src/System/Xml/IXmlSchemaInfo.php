<?php

namespace System\Xml {


	/**
     * Defines the post-schema-validation infoset of a validated XML node.
     * @access public
     * @name IXmlSchemaInfo
     * @package System
     * @subpackage Xml
     */
	interface IXmlSchemaInfo {


		/**
		 * Gets a value indicating if this validated XML node was set as the result of a default being applied during XML Schema Definition Language (XSD) schema validation. 
		 * @access public
		 * @return bool true if this validated XML node was set as the result of a default being applied during schema validation; otherwise, false. 
		*/
		function isDefault();


		/**
		 * Gets a value indicating if the value for this validated XML node is nil. 
		 * @access public
		 * @return bool true if the value for this validated XML node is nil; otherwise, false. 
		*/
		function isNil();

		/**
		 * Gets the dynamic schema type for this validated XML node. 
		 * @access public
		 * @return \System\Xml\Schema\XmlSchemaSimpleType An XmlSchemaSimpleType. 
		*/
		function memberType();

		/**
		 * Gets the compiled XmlSchemaAttribute that corresponds to this validated XML node. 
		 * @access public
		 * @return \System\Xml\Schema\XmlSchemaAttribute An XmlSchemaAttribute. 
		*/
		function schemaAttribute();

		/**
		 * Gets the compiled XmlSchemaElement that corresponds to this validated XML node. 
		 * @access public
		 * @return \System\Xml\Schema\XmlSchemaElement An XmlSchemaElement.
		*/
		function schemaElement();

		/**
		 * Gets the static XML Schema Definition Language (XSD) schema type of this validated XML node. 
		 * @access public
		 * @return \System\Xml\Schema\XmlSchemaType An XmlSchemaType.
		*/
		function schemaType();

		/**
		 * Gets the XmlSchemaValidity value of this validated XML node. 
		 * @access public
		 * @return \System\Xml\Schema\XmlSchemaValidity An XmlSchemaValidity.
		*/
		function validity();

	}
}