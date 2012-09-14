<?php

namespace System\Collections\Specialized {

    /*
     * Class to work with Iterator
     */
    class CollectionIterator {

        private $_list;
        private $_current = 0;

        /*
         * Construct received any object that implements ICollection
         */
        public function __construct($collection){
            $this->_list = $collection->toArray();
        }

        /*
         * Get First Element
         *
         * @return  object
         */
        public function first() {
            return $this->_list[0];
        }

        /*
         * Get next element
         *
         * @return  object
         */
        public function next() {
            if(!$this->hasNext()) throw new Exception("Don't exists elements");
            return $this->_list[++$this->_current];
        }

        /*
         * Verify if has next element
         *
         * @return  bool
         */
        public function hasNext() {
            if(($this->_current + 1) < sizeof($this->_list)) return true;
            return false;
        }

        /*
         * Get Current Element
         *
         * @return object
         */
        public function current() {
            return $this->_list[$this->_current];
        }
    }
}