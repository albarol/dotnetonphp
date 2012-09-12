<?php

namespace System\Xml {


	use \System\Xml\XmlNamedNodeMap as XmlNamedNodeMap;
	use \System\Xml\XmlAttribute as XmlAttribute;
	
	use \System\Collections\ICollection as ICollection;
	use \System\Collections\IEnumerable as IEnumerable;




	/**
     * Represents a collection of attributes that can be accessed by name or index. 
     * @access public
     * @name XmlAttributeCollection
     * @package System
     * @subpackage Xml
     */
	class XmlAttributeCollection extends XmlNamedNodeMap implements ICollection, IEnumerable {

		/**
		 * Inserts the specified attribute as the last node in the collection. 
		 * @access public
		 * @throws \System\ArgumentException node was created from a document different from the one that created this collection. 
		 * @param \System\Xml\XmlAttribute The XmlAttribute to insert.
		 * @return \System\Xml\XmlAttribute The XmlAttribute to append to the collection. 
		*/
		public function append(XmlAttribute $node) { }

		/**
		 * Copies the elements of the System.Collections.ICollection to an System.Array, starting at a particular System.Array index.
		 * @access public
		 * @throws ArgumentNullException array is a null reference.
		 * @throws ArgumentOutOfRangeException index is less than zero. 
		 * @throws ArgumentException array is multidimensional. -or- index is equal to or greater than the length of array. -or- The number of elements in the source ICollection is greater than the available space from index to the end of the destination array. 
		 * @param array $array The one-dimensional Array that is the destination of the elements copied from ICollection. The System.Array must have zero-based indexing.
		 * @param int $index The zero-based index in array at which copying begins.
		 * @return void
		*/
		public function copyTo(array &$array, $index=0) { }


		/**
		 * Gets the attribute with the specified name or index.
		 * @access public
		 * @param object $item Gets the attribute with the specified index. -or- Gets the attribute with the specified name.
		 * @return \System\Xml\XmlAttribute The XmlAttribute with the specified name. 
		*/
		public function itemOf($item) { 
			if(is_int($item)) {
				return $this->numericItemOf($item);	
			} else {
				return $this->nameItemOf($item);	
			}
		}

		private function numericItemOf($index) {
			return new XmlAttribute($this->namedNodeMap->item($index));
		}

		private function nameItemOf($name) { 
			return new XmlAttribute($this->namedNodeMap->getNamedItem($name));
		}
	} 
}
