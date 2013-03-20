<?php

namespace System\Collections 
{
    use \System\Collections\ICollection as ICollection;

    /**
     * Represents a nongeneric collection of key/value pairs.
     * @access public
     * @name IDictionary
     * @package System
     * @subpackage Collections
     */
    interface IDictionary extends ICollection 
    {
        /**
         * Adds an element with the provided key and value to the System.Collections.IDictionary object.
         * @access public
         * @throws ArgumentNullException|ArgumentException|NotSupportedException
         * @param $key The System.Object to use as the key of the element to add.
         * @param $value The System.Object to use as the value of the element to add.
         */
        function add($key, $value);

        /**
         * Removes all elements from the System.Collections.IDictionary object.
         * @access public
         * @throws NotSupportedException
         */
        function clear();

        /**
         * Determines whether the IDictionary object contains an element with the specified key.
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @abstract
         * @param object $key The key to locate in the IDictionary object.
         * @return boolean true if the IDictionary contains an element with the key; otherwise, false.
         */
        function contains($key);

        /**
         * Removes the element with the specified key from the System.Collections.IDictionary object.
         * @access public
         * @throws ArgumentNullException|NotSupportedException
         * @param $key The key of the element to remove.
         */
        function remove($key);

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object has a fixed size.
         * @access public
         * @return boolean true if the System.Collections.IDictionary object has a fixed size; otherwise, false.
         */
        function isFixedSize();

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object is read-only.
         * @access public
         * @return boolean true if the System.Collections.IDictionary object is read-only; otherwise, false.
         */
        function isReadOnly();

        /**
         * Gets an System.Collections.ICollection object containing the keys of the System.Collections.IDictionary object.
         * @access public
         * @return ICollection An System.Collections.ICollection object containing the keys of the System.Collections.IDictionary object.
         */
        function keys();

        /**
         * Gets the element with the specified key.
         * @access public
         * @throws ArgumentNullException|NotSupportedException
         * @param $key The key of the element to get or set.
         * @return object The element with the specified key.
         */
        function get($key);


        /**
         * Gets the element with the specified key.
         * @access public
         * @throws ArgumentNullException|NotSupportedException
         * @param $key The key of the element to get or set.
         * @param $value The element added
         * @return void
         */
        function set($key, $value);


        /**
         * Gets an System.Collections.ICollection object containing the values in the System.Collections.IDictionary object.
         * @access public
         * @return ICollection An System.Collections.ICollection object containing the values in the System.Collections.IDictionary object.
         */
         function values();
    }
}