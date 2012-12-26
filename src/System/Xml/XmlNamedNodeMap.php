<?php

namespace System\Xml {

	use \System\Collections\IEnumerable as IEnumerable;

	use \System\Xml\XmlAttribute as XmlAttribute;

	
	/**
	 * Represents a collection of nodes that can be accessed by name or index.
     * @access public
     * @name XmlNamedNodeMap
     * @package System
     * @subpackage Xml
     */
	class XmlNamedNodeMap implements IEnumerable {

		protected $namedNodeMap;

		/**
        * This constructor supports the .NET Framework infrastructure and is not intended to be used directly from your code. 
        * @access private
        */
        public function __construct(\DOMNamedNodeMap $namedNodeMap) {
            $this->namedNodeMap = $namedNodeMap;
        }


		/**
		 * Gets the number of nodes in the XmlNamedNodeMap.
		 * @access public
		 * @return int The number of nodes.
		*/
		public function count() { 
			return $this->namedNodeMap->length;
		}


		/**
		 * Retrieves an XmlNode specified by name.
		 * @access public
		 * @param string $name The qualified name of the node to retrieve. It is matched against the Name property of the matching node.
		 * @return \System\Xml\XmlNode An XmlNode with the specified name or null if a matching node is not found.
		*/
		public function getNamedItem($name) { }

		/**
	     * Returns an enumerator that iterates through a collection.
	     * @access public
	     * @return \System\Collections\IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
	     */
	    public function getEnumerator() { }

		/**
		 * Retrieves the node at the specified index in the XmlNamedNodeMap.
		 * @access public
		 * @param int $index The index position of the node to retrieve from the XmlNamedNodeMap. The index is zero-based; therefore, the index of the first node is 0 and the index of the last node is Count -1. 
		 * @return \System\Xml\XmlNode The XmlNode at the specified index. If index is less than 0 or greater than or equal to the Count property, a null reference is returned. 
		*/
		public function item($index) { 
			return new XmlAttribute($this->namedNodeMap->item($index));
		}


		/**
		 * Removes the node from the XmlNamedNodeMap.
		 * @access public
		 * @param string $name The qualified name of the node to remove. The name is matched against the Name property of the matching node.
		 * @return \System\Xml\XmlNode The XmlNode removed from this XmlNamedNodeMap or null if a matching node was not found.
		*/
		public function removeNamedItem($name) { }


		/**
		 * Adds an XmlNode using its Name property 
		 * @access public
		 * @throws \System\ArgumentException The node was created from a different XmlDocument than the one that created the XmlNamedNodeMap; or the XmlNamedNodeMap is read-only. 
		 * @param \System\Xml\XmlNode $node An XmlNode to store in the XmlNamedNodeMap. If a node with that name is already present in the map, it is replaced by the new one. 
		 * @return \System\Xml\XmlNode If the node replaces an existing node with the same name, the old node is returned; otherwise, a null reference is returned.
		*/
		public function setNamedItem($node) { }

	} 
}
