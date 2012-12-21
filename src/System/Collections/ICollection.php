<?php

namespace System\Collections { 

  use \System\Collections\IEnumerable as IEnumerable;

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
       * @access public
       * @throws \System\ArgumentNullException array is a null reference.
       * @throws \System\ArgumentOutOfRangeException index is less than zero. 
       * @throws \System\ArgumentException array is multidimensional. -or- index is equal to or greater than the length of array. -or- The number of elements in the source ICollection is greater than the available space from index to the end of the destination array. 
       * @param array $array The one-dimensional Array that is the destination of the elements copied from ICollection. The System.Array must have zero-based indexing.
       * @param int $index The zero-based index in array at which copying begins.
       * @return void
       */
      function copyTo(array &$array, $index=0);

       /**
        * Gets the number of elements contained in the ICollection.
        * @access public
        * @return int The number of elements contained in the ICollection.
        */
       function count();
  }
}
