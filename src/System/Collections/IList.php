<?php

namespace System\Collections;

require_once("ICollection.php");

/**
 * Represents a non-generic collection of objects that can be individually accessed by index.
 * @access public
 * @name IList
 * @package System
 * @subpackage Collections
 */
interface IList extends ICollection {

    /**
     * Adds an item to the System.Collections.IList.
     * @abstract
     * @access public
     * @param object $value The System.Object to add to the System.Collections.IList.
     * @return int The position into which the new element was inserted.
     */
    function add($value);

    /**
     * Removes all items from the System.Collections.IList.
     * @abstract
     * @access public
     * @throws NotSupportedException
     * @return void
     */
    function clear();

    /**
     * Determines whether the System.Collections.IList contains a specific value.
     * @abstract
     * @access public
     * @param object $value The System.Object to locate in the System.Collections.IList.
     * @return bool true if the System.Object is found in the System.Collections.IList; otherwise, false.
     */
    function contains($value);

    /**
     * Gets the element at the specified index.
     * @abstract
     * @access public
     * @throws System.ArgumentOutOfRangeException
     * @param int $index The zero-based index of the element to get
     * @return The element at the specified index.
     */
    function get($index);

    /**
     * Determines the index of a specific item in the System.Collections.IList.
     * @abstract
     * @access public
     * @param object $value The System.Object to locate in the System.Collections.IList.
     * @return The index of value if found in the list; otherwise, -1.
     */
    function indexOf($value);

    /**
     * Inserts an item to the System.Collections.IList at the specified index.
     * @abstract
     * @access public
     * @throws ArgumentOutOfRangeException|NotSupportedException|NullReferenceException
     * @param $index The zero-based index at which value should be inserted.
     * @param $value The System.Object to insert into the System.Collections.IList.
     * @return void
     */
    function insert($index, $value);

    /**
     * Removes the first occurrence of a specific object from the System.Collections.IList.
     * @abstract
     * @access public
     * @throws NotSupportedException
     * @param object $value The System.Object to remove from the System.Collections.IList.
     * @return void
     */
    function remove($value);

    /**
     * Removes the System.Collections.IList item at the specified index.
     * @abstract
     * @access public
     * @throws ArgumentOutOfRangeException|NotSupportedException
     * @param int $index The zero-based index of the item to remove.
     * @return void
     */
    function removeAt($index);

    /**
     * Gets a value indicating whether the System.Collections.IList has a fixed size.
     * @abstract
     * @access public
     * @return true if the System.Collections.IList has a fixed size; otherwise, false.
     */
    function isFixedSize();

    /**
     * Gets a value indicating whether the System.Collections.IList is read-only.
     * @abstract
     * @access public
     * @return bool true if the System.Collections.IList is read-only; otherwise, false.
     */
    function isReadOnly();
}
?>
