<?php

namespace System\Collections;

require_once("IEnumerable.php");


/**
 * Defines size, enumerators, and synchronization methods for all nongeneric collections.
 * @access public
 * @name ICollection
 * @interface
 * @package System
 * @subpackage Collections
 */
interface ICollection extends IEnumerable {

    /**
     * Copies the elements of the System.Collections.ICollection to an System.Array, starting at a particular System.Array index.
     * @abstract
     * @access public
     * @throws ArgumentNullException|ArgumentOutOfRangeException|ArgumentException
     * @param array $array The one-dimensional System.Array that is the destination of the elements copied from System.Collections.ICollection. The System.Array must have zero-based indexing.
     * @param int $index The zero-based index in array at which copying begins.
     * @return void
     */
    function copyTo(array &$array, $index=0);

     /**
      * Gets the number of elements contained in the System.Collections.ICollection.
      * @access public
      * @abstract
      * @return int The number of elements contained in the System.Collections.ICollection.
      */
     function count();
}
?>
