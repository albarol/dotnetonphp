<?php

namespace System\Collections {

    /**
     * Supports a simple iteration over a nongeneric collection.
     * @access public
     * @name IEnumerator
     * @package System
     * @subpackage Collections
     */
    interface IEnumerator {
      
        /**
         * Advances the enumerator to the next element of the collection.
         * @access public
         * @return bool true if the enumerator was successfully advanced to the next element; false if the enumerator has passed the end of the collection.
         */
        function moveNext();

        /**
         * Sets the enumerator to its initial position, which is before the first element in the collection.
         * @access public
         * @return void
         */
        function reset();

        /**
         * Gets the current element in the collection.
         * @access public
         * @return object The current element in the collection.
         */
        function current();
    }
}
