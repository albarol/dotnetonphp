<?php

namespace System\Collections\Generic {

    use System\Collections\IEnumerator as IEnumerator;

    use System\InvalidOperationException as InvalidOperationException;
    

    /**
     * Class to provide Base Enumerates the elements.
     * @access public
     * @name BaseEnumerator
     * @package System
     * @subpackage Collections\Generic
     */
    abstract class BaseEnumerator implements IEnumerator {

        protected $position = -1;
        protected $source;

        /**
         * Advances the enumerator to the next element of the collection.
         * @access public
         * @return bool true if the enumerator was successfully advanced to the next element; false if the enumerator has passed the end of the collection.
         */
        public function moveNext() {
            if($this->position == $this->sizeOfSource()) return false;
            $this->position++;
            return true;
        }

        private function sizeOfSource() {
            return (sizeof($this->source) - 1);
        }

        /**
         * Sets the enumerator to its initial position, which is before the first element in the collection.
         * @access public
         * @return void
         */
        public function reset() {
            $this->position = 0;
        }

        /**
         * Gets the current element in the collection.
         * @access public
         * @throws InvalidOperationException
         * @return object The current element in the collection.
         */
        public function current() {
            if($this->position < 0) throw new InvalidOperationException("The enumerator is positioned before the first element of the collection or after the last element.");
            return $this->source[$this->position];

        }
    }
}