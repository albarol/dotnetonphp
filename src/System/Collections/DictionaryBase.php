<?php

namespace System\Collections {

    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;

    use \System\Collections\IDictionary as IDictionary;

    /**
     * Provides the abstract base class for a strongly typed collection of key/value pairs.
     * @access public
     * @abstract
     * @name DictionaryBase
     * @package System
     * @subpackage Collections
     */
    abstract class DictionaryBase implements IDictionary {

        protected $elements = array();

       /**
         * Adds an element with the provided key and value to the System.Collections.IDictionary object.
         *
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @throws \System\ArgumentException An element with the same key already exists in the DictionaryBase. 
         * @throws \System\NotSupportedException The DictionaryBase is read-only. -or- The DictionaryBase has a fixed size.
         * @param $key The System.Object to use as the key of the element to add.
         * @param $value The System.Object to use as the value of the element to add.
         */
         public function add($key, $value) {
            if (is_null($key)) {
                throw new ArgumentNullException("key is null");
            }
            if ($this->contains($key)) {
                throw new ArgumentException("An element with the same key already exists in the DictionaryBase.");
            }
            $this->elements[$key] = $value;
         } 

        /**
         * Removes all elements from the System.Collections.IDictionary object.
         *
         * @access public
         * @throws \System\NotSupportedException The DictionaryBase is read-only.
         */
        public function clear() {
            $this->elements = array();
        }

        /**
         * Determines whether the System.Collections.IDictionary object contains an element with the specified key.
         *
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @param $key The key to locate in the \System\Collections\IDictionary object.
         * @return boolean true if the \System\Collections\IDictionary contains an element with the key; otherwise, false.
         */
        public function contains($key) {
            if (is_null($key)) {
                throw new ArgumentNullException("key is null.");
            }
            return array_key_exists($key, $this->elements);
        }

        /**
         * Copies the elements of the \System\Collections\ICollection to an \System\Array, starting at a particular System.Array index.
         *
         * @access public
         * @throws \System\ArgumentOutOfRangeException index is less than zero.
         * @throws \System\ArgumentException index is equal to or greater than the length of array.
         * @param array $array The one-dimensional System.Array that is the destination of the elements copied from \System\Collections\ICollection. The \System\Array must have zero-based indexing.
         * @param int $index The zero-based index in array at which copying begins.
         * @return array Elements of the \System\Collections\ICollection
         */
        public function copyTo($index = 0) {
            if ($index < 0) { 
                throw new ArgumentOutOfRangeException("index is null");
            }
            if ($index >= $this->count()) {
                throw new ArgumentException("index is equal to or greater than the length of array.");
            }
            return array_slice($this->elements, $index);
        }

        /**
         * Gets the number of elements contained in the System.Collections.ICollection.
         *
         * @access public
         * @return int The number of elements contained in the System.Collections.ICollection.
         */
        public function count() {
            return sizeof($this->elements);
        } 

        /**
         * Removes the element with the specified key from the System.Collections.IDictionary object.
         * @access public
         * @throws ArgumentNullException|NotSupportedException
         * @param $key The key of the element to remove.
         */
        public function remove($key) {
            // TODO: Implement remove() method.
        }

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object has a fixed size.
         * @access public
         * @return boolean true if the System.Collections.IDictionary object has a fixed size; otherwise, false.
         */
        public function isFixedSize() {
            // TODO: Implement isFixedSize() method.
        }

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object is read-only.
         * @access public
         * @return boolean true if the System.Collections.IDictionary object is read-only; otherwise, false.
         */
        public function isReadOnly() {
            // TODO: Implement isReadOnly() method.
        }

        /**
         * Gets an System.Collections.ICollection object containing the keys of the System.Collections.IDictionary object.
         * @access public
         * @return ICollection An System.Collections.ICollection object containing the keys of the System.Collections.IDictionary object.
         */
        public function keys() {
            // TODO: Implement keys() method.
        }

        /**
         * Gets the element with the specified key.
         * @access public
         * @throws ArgumentNullException|NotSupportedException
         * @param $key The key of the element to get or set.
         * @return object The element with the specified key.
         */
        public function get($key) {
            // TODO: Implement get() method.
        }

        /**
         * Gets the element with the specified key.
         * @access public
         * @throws ArgumentNullException|NotSupportedException
         * @param $key The key of the element to get or set.
         * @param $value The element added
         * @return void
         */
        public function set($key, $value) {
            // TODO: Implement set() method.
        }

        /**
         * Gets an System.Collections.ICollection object containing the values in the System.Collections.IDictionary object.
         * @access public
         * @return ICollection An System.Collections.ICollection object containing the values in the System.Collections.IDictionary object.
         */
        public function values() {
            // TODO: Implement values() method.
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            // TODO: Implement getEnumerator() method.
        }
    }
}