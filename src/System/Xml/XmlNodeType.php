<?php

namespace System\Xml {


	use \System\Enum as Enum;

	/**
     * Specifies the type of node. 
     * @access public
     * @name XmlNodeType
     * @package System
     * @subpackage Xml
     */
	final class XmlNodeType extends Enum {

		/**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
		private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }


		/**
		 * An Attribute node can have the following child node types: Text and EntityReference. The Attribute node does not appear as the child node of any other node type. It is not considered a child node of an Element.
		*/
		public static function attribute() {
            return new XmlNodeType("ATTRIBUTE", 2);
        }

		/**
		 * CDATA sections are used to escape blocks of text that would otherwise be recognized as markup. A CDATA node cannot have any child nodes. It can appear as the child of the DocumentFragment, EntityReference, and Element nodes.
		*/
		public static function cdata() {
            return new XmlNodeType("CDATA", 4);
        }

		/**
		 * A Comment node cannot have any child nodes. It can appear as the child of the Document, DocumentFragment, Element, and EntityReference nodes.
		*/
		public static function comment() {
            return new XmlNodeType("COMMENT", 8);
        }

		/**
		 * A Document node can have the following child node types: XmlDeclaration, Element (maximum of one), ProcessingInstruction, Comment, and DocumentType. It cannot appear as the child of any node types.
		*/
		public static function document() {
            return new XmlNodeType("DOCUMENT", 9);
        }

		/**
		 * The DocumentFragment node associates a node or subtree with a document without actually being contained within the document. A DocumentFragment node can have the following child node types: Element, ProcessingInstruction, Comment, Text, CDATA, and EntityReference. It cannot appear as the child of any node types.
		*/
		public static function documentFragment() {
            return new XmlNodeType("DOCUMENT_FRAGMENT", 11);
        }

		/**
		 * A DocumentType node can have the following child node types: Notation and Entity. It can appear as the child of the Document node.
		*/
		public static function documentType() {
            return new XmlNodeType("DOCUMENT_TYPE", 10);
        }

		/**
		 * An Element node can have the following child node types: Element, Text, Comment, ProcessingInstruction, CDATA, and EntityReference. It can be the child of the Document, DocumentFragment, EntityReference, and Element nodes.
		*/
		public static function element() {
            return new XmlNodeType("ELEMENT", 1);
        }

		/**
		 * An Entity node can have child nodes that represent the expanded entity (for example, Text and EntityReference nodes). It can appear as the child of the DocumentType node.
		*/
		public static function entity() {
            return new XmlNodeType("ENTITY", 6);
        }

		/**
		 * An EntityReference node can have the following child node types: Element, ProcessingInstruction, Comment, Text, CDATA, and EntityReference. It can appear as the child of the Attribute, DocumentFragment, Element, and EntityReference nodes.
		*/
		public static function entityReference() {
            return new XmlNodeType("ENTITY_REFERENCE", 5);
        }

		/**
		 * A Notation node cannot have any child nodes. It can appear as the child of the DocumentType node.
		*/
		public static function notation() {
            return new XmlNodeType("NOTATION", 12);
        }

		/**
		 * A ProcessingInstruction node cannot have any child nodes. It can appear as the child of the Document, DocumentFragment, Element, and EntityReference nodes.
		*/
		public static function processingInstruction() {
            return new XmlNodeType("PROCESSING_INSTRUCTION", 7);
        }	

		/**
		 * A Text node cannot have any child nodes. It can appear as the child node of the Attribute, DocumentFragment, Element, and EntityReference nodes.
		*/
		public static function text() {
            return new XmlNodeType("TEXT", 3);
        }
	}
}