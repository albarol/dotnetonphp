<?php

namespace System\Collections {

    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;

    use \System\Collections\IDictionary as IDictionary;
    use \System\Collections\KeyNotFoundException as KeyNotFoundException;

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
         * @throws \System\ArgumentNullException key is a null reference
         * @throws \System\ArgumentException An element with the same key already exists in the IDictionary.
         * @throws \System\NotSupportedException The IDictionary is read-only.
         * @param $key The \System\Object to use as the key of the element to add.
         * @param $value The \System\Object to use as the value of the element to add.
         */
         public function add($key, $value) {
            if (is_null($key)) {
                throw new ArgumentNullException("key is null");
            }
            if ($this->containsKey($key)) {
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
         * Determines whether the IDictionary object contains an element with the specified key.
         *
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @param object $key The key to locate in the IDictionary object.
         * @return boolean true if the IDictionary contains an element with the key; otherwise, false.
         */
        public function containsKey($key) {
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
         * Gets the element with the specified key.
         *
         * @access public
         * @throws \System\ArgumentNullException key is a null reference
         * @throws \System\KeyNotFoundException The property is retrieved and key is not found.
         * @param $key The key of the element to get.
         * @return object The element with the specified key.
         */
         public function get($key) {
            if (is_null($key)) {
                throw new ArgumentNullException("key is null.");
            }
            if (!$this->containsKey($key)) {
                throw new KeyNotFoundException("The property is retrieved and key is not found.");
            }
            return $this->elements[$key];
         }

        /**
         * Removes the element with the specified key from the System.Collections.IDictionary object.
         * 
         * @access public
         * @throws \System\ArgumentNullException key is a null reference 
         * @throws \System\NotSupportedException The IDictionary is read-only.
         * @param $key The key of the element to remove.
         * @return true if the element is successfully removed; otherwise, false. This method also returns false if key was not found in the original IDictionary. 
         */
         public function remove($key) {
            if (is_null($key)) {
                throw new ArgumentNullException("key is null.");
            }
            if (!$this->containsKey($key)) {
                return false;
            }
            unset($this->elements[$key]);
            return true;
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
         * Gets an array containing the keys of the IDictionary. 
         *
         * @access public
         * @return array An array object containing the keys of the \System\Collections\IDictionary object.
         */
        public function keys() {
            return array_keys($this->elements);
        }

        /**
         * Set the element with the specified key.
         *
         * @access public
         * @throws \System\ArgumentNullException key is a null reference
         * @throws \System\KeyNotFoundException The property is retrieved and key is not found.
         * @throws \System\NotSupportedException The property is set and the IDictionary is read-only.
         * @param $key The key of the element to set.
         * @param $value The element added
         * @return void
         */
        public function set($key, $value) {
           if (is_null($key)) {
                throw new ArgumentNullException("key is null.");
           }
           if (!$this->containsKey($key)) {
                throw new KeyNotFoundException("The property is retrieved and key is not found.");
           }
           $this->elements[$key] = $value;
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