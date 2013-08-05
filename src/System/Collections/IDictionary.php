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
         *
         * @access public
         * @abstract
         * @throws \System\ArgumentNullException key is a null reference
         * @throws \System\ArgumentException An element with the same key already exists in the IDictionary.
         * @throws \System\NotSupportedException The IDictionary is read-only.
         * @param $key The \System\Object to use as the key of the element to add.
         * @param $value The \System\Object to use as the value of the element to add.
         */
        function add($key, $value);

        /**
         * Determines whether the IDictionary object contains an element with the specified key.
         *
         * @access public
         * @abstract
         * @throws \System\ArgumentNullException key is null.
         * @param object $key The key to locate in the IDictionary object.
         * @return boolean true if the IDictionary contains an element with the key; otherwise, false.
         */
        function containsKey($key);

        /**
         * Gets the element with the specified key.
         *
         * @access public
         * @abstract
         * @throws \System\ArgumentNullException key is a null reference
         * @throws \System\KeyNotFoundException The property is retrieved and key is not found.
         * @param $key The key of the element to get.
         * @return object The element with the specified key.
         */
        function get($key);

        /**
         * Gets an \System\Collections\ICollection containing the keys of the IDictionary. 
         *
         * @access public
         * @abstract
         * @return \System\Collections\ICollection An \System\Collections\ICollection object containing the keys of the \System\Collections\IDictionary object.
         */
        function keys();

        /**
         * Removes the element with the specified key from the System.Collections.IDictionary object.
         * @access public
         * @abstract
         * @throws \System\ArgumentNullExceptionkey is a null reference 
         * @throws \System\NotSupportedException The IDictionary is read-only.
         * @param $key The key of the element to remove.
         * @return true if the element is successfully removed; otherwise, false. This method also returns false if key was not found in the original IDictionary. 
         */
        function remove($key);

        /**
         * Gets the element with the specified key.
         *
         * @access public
         * @abstract
         * @throws \System\ArgumentNullException key is a null reference
         * @throws \System\KeyNotFoundException The property is retrieved and key is not found.
         * @throws \System\NotSupportedException The property is set and the IDictionary is read-only.
         * @param $key The key of the element to set.
         * @param $value The element added
         * @return void
         */
        function set($key, $value);

        /**
         * Gets an \System\Collections\ICollection object containing the values in the \System\Collections\IDictionary object.
         *
         * @access public
         * @abstract
         * @return \System\Collections\ICollection An \System\Collections\ICollection object containing the values in the \System\Collections\IDictionary object.
         */
         function values();


    }
}