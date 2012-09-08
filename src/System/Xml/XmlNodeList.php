<?php

namespace System\Xml { 

    use \System\Collections\IEnumerable as IEnumerable;

    /**
     * Represents an ordered collection of nodes.
     * @access public
     * @name XmlNodeList
     * @package System
     * @subpackage Xml
     */
    abstract class XmlNodeList implements IEnumerable {

        /**
         * Retrieves a node at the given index.
         * @abstract
         * @param $index Zero-based index into the list of nodes. 
         * @return XmlNode The XmlNode in the collection.If index is greater than or equal to the number of nodes in the list, this returns Nothing.
         */
        public abstract function item($index);


        /**
         * Gets the number of nodes in the XmlNodeList.
         * @access public
         * @return int The number of nodes.
         */
        public abstract function count();
    }
}