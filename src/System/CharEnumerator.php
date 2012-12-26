<?php

namespace System {

    use \System\ICloneable as ICloneable;
    
    use \System\Collections\IEnumerator as IEnumerator;


    /**
     * Supports iterating over a String object and reading its individual characters. This class cannot be inherited.
     * @access public
     * @name CharEnumerator
     * @package System
     */
    final class CharEnumerator implements ICloneable, IEnumerator {

        /**
         * Creates a new object that is a copy of the current instance.
         * @access public
         * @return object A new object that is a copy of this instance.
         */
        public function cloneObject() { }

        /**
         * Gets the current element in the collection.
         * @access public
         * @return object The current element in the collection.
         */
        public function current() { }

        /**
         * Advances the enumerator to the next element of the collection.
         * @access public
         * @return bool true if the enumerator was successfully advanced to the next element; false if the enumerator has passed the end of the collection.
         */
        public function moveNext() { }

        /**
         * Sets the enumerator to its initial position, which is before the first element in the collection.
         * @access public
         * @return void
         */
        public function reset() { }

        
    }
}
