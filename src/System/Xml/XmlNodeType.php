<?php

namespace System\Xml {

	/**
     * Specifies the type of node. 
     * @access public
     * @name XmlNodeType
     * @package System
     * @subpackage Xml
     */
	final class XmlNodeType {

		/**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
		private function __construct() { }


		/**
		 * An Attribute node can have the following child node types: Text and EntityReference. The Attribute node does not appear as the child node of any other node type. It is not considered a child node of an Element.
		*/
		const Attribute = 2;

		/**
		 * CDATA sections are used to escape blocks of text that would otherwise be recognized as markup. A CDATA node cannot have any child nodes. It can appear as the child of the DocumentFragment, EntityReference, and Element nodes.
		*/
		const CDATA = 4;

		/**
		 * A Comment node cannot have any child nodes. It can appear as the child of the Document, DocumentFragment, Element, and EntityReference nodes.
		*/
		const Comment = 8;

		/**
		 * A Document node can have the following child node types: XmlDeclaration, Element (maximum of one), ProcessingInstruction, Comment, and DocumentType. It cannot appear as the child of any node types.
		*/
		const Document = 9;

		/**
		 * The DocumentFragment node associates a node or subtree with a document without actually being contained within the document. A DocumentFragment node can have the following child node types: Element, ProcessingInstruction, Comment, Text, CDATA, and EntityReference. It cannot appear as the child of any node types.
		*/
		const DocumentFragment = 11;		

		/**
		 * A DocumentType node can have the following child node types: Notation and Entity. It can appear as the child of the Document node.
		*/
		const DocumentType = 10;

		/**
		 * An Element node can have the following child node types: Element, Text, Comment, ProcessingInstruction, CDATA, and EntityReference. It can be the child of the Document, DocumentFragment, EntityReference, and Element nodes.
		*/
		const Element = 1;

		/**
		 * An Entity node can have child nodes that represent the expanded entity (for example, Text and EntityReference nodes). It can appear as the child of the DocumentType node.
		*/
		const Entity = 6;

		/**
		 * An EntityReference node can have the following child node types: Element, ProcessingInstruction, Comment, Text, CDATA, and EntityReference. It can appear as the child of the Attribute, DocumentFragment, Element, and EntityReference nodes.
		*/
		const EntityReference = 5;

		/**
		 * A Notation node cannot have any child nodes. It can appear as the child of the DocumentType node.
		*/
		const Notation = 12;

		/**
		 * A ProcessingInstruction node cannot have any child nodes. It can appear as the child of the Document, DocumentFragment, Element, and EntityReference nodes.
		*/
		const ProcessingInstruction = 7;		

		/**
		 * A Text node cannot have any child nodes. It can appear as the child node of the Attribute, DocumentFragment, Element, and EntityReference nodes.
		*/
		const Text = 3;
	}

}