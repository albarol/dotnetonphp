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

        protected $dictionary = array();
        protected $isFixedSize = false;
        protected $isReadOnly = false;

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
            if ($this->contains($key)) {
                throw new ArgumentException("An element with the same key already exists in the DictionaryBase.");
            }
            $this->onInsert($key, $value);
            $this->dictionary[$key] = $value;
            $this->onInsertComplete($key, $value);
         } 

        /**
         * Removes all elements from the System.Collections.IDictionary object.
         *
         * @access public
         * @throws \System\NotSupportedException The DictionaryBase is read-only.
         */
        public function clear() {
            $this->onClear();
            $this->dictionary = array();
            $this->onClearComplete();
        }

        /**
         * Determines whether the IDictionary object contains an element with the specified key.
         *
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @param object $key The key to locate in the IDictionary object.
         * @return boolean true if the IDictionary contains an element with the key; otherwise, false.
         */
        public function contains($key) {
            if (is_null($key)) {
                throw new ArgumentNullException("key is null.");
            }
            return array_key_exists($key, $this->dictionary);
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
            return array_slice($this->dictionary, $index);
        }

        /**
         * Gets the number of elements contained in the System.Collections.ICollection.
         *
         * @access public
         * @return int The number of elements contained in the System.Collections.ICollection.
         */
        public function count() {
            return sizeof($this->dictionary);
        }

        /**
         * Determines whether the specified Object is equal to the current Object.
         *
         * @access public
         * @param object The object to compare with the current object
         * @return bool  true if the specified Object is equal to the current Object; otherwise, false.
        */
        public function equals($obj) {
            return $this === $obj;
        }

        /**
         * Allows an Object to attempt to free resources and perform other cleanup operations before the Object is reclaimed by garbage collection. 
         *
         * @abstract
         * @access protected
         * @return void
         */
        protected abstract function finalize();

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
            if (!$this->contains($key)) {
                throw new KeyNotFoundException("The property is retrieved and key is not found.");
            }
            $value = $this->dictionary[$key];
            $this->onGet($key, $value);
            return $value;
         }

         /**
          * Performs additional custom processes before clearing the contents of the DictionaryBase instance. 
          *
          * @abstract
          * @access protected
          */
         protected abstract function onClear();


         /**
          * Performs additional custom processes after clearing the contents of the DictionaryBase instance. 
          * 
          * @abstract
          * @access protected
         */ 
         protected abstract function onClearComplete();


         /**
          * Gets the element with the specified key and value in the DictionaryBase instance.
          *
          * @abstract
          * @access protected
         */
         protected abstract function onGet($key, $currentValue);


         /**
          *  Performs additional custom processes before inserting a new element into the DictionaryBase instance. 
          *
          * @abstract
          * @access protected
         */
         protected abstract function onInsert($key, $value);


         /**
          *  Performs additional custom processes after inserting a new element into the DictionaryBase instance. 
          *
          * @abstract
          * @access protected
         */
         protected abstract function onInsertComplete($key, $value);


         /**
          * Performs additional custom processes before removing an element from the DictionaryBase instance.
          *
          * @abstract
          * @access protected
         */
         protected abstract function onRemove($key, $value);


         /**
          * Performs additional custom processes after removing an element from the DictionaryBase instance. 
          *
          * @abstract
          * @access protected
         */
         protected abstract function onRemoveComplete($key, $value);

         /**
          *  Performs additional custom processes before setting a value in the DictionaryBase instance. 
          * 
          * @abstract
          * @access protected
         */
         protected abstract function onSet($key, $oldValue, $newValue);

        /**
         * Performs additional custom processes after setting a value in the DictionaryBase instance. 
         *
         * @abstract
         * @access protected
         */
         protected abstract function onSetComplete($key, $oldValue, $newValue);

         /**
          * Performs additional custom processes when validating the element with the specified key and value. 
          *
          * @abstract
          * @access protected
         */
         protected abstract function onValidate($key, $value);


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
            if (!$this->contains($key)) {
                return false;
            }
            $value = $this->dictionary[$key];
            $this->onRemove($key, $value);
            unset($this->dictionary[$key]);
            $this->onRemoveComplete($key, $value);
            return true;
         }

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object has a fixed size.
         *
         * @access public
         * @return boolean true if the System.Collections.IDictionary object has a fixed size; otherwise, false.
         */
        public function isFixedSize() {
            return $this->isFixedSize;
        }

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object is read-only.
         *
         * @access public
         * @return boolean true if the System.Collections.IDictionary object is read-only; otherwise, false.
         */
        public function isReadOnly() {
            return $this->isReadOnly;
        }

        /**
         * Gets an array containing the keys of the IDictionary. 
         *
         * @access public
         * @return array An array object containing the keys of the \System\Collections\IDictionary object.
         */
        public function keys() {
            return array_keys($this->dictionary);
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
           if (!$this->contains($key)) {
                throw new KeyNotFoundException("The property is retrieved and key is not found.");
           }
           $oldValue = $this->dictionary[$key];
           $this->onSet($key, $oldValue, $value);
           $this->dictionary[$key] = $value;
           $this->onSetComplete($key, $oldValue, $value);
        }

        /**
         * Gets an array containing the values in the \System\Collections\IDictionary object.
         *
         * @access public
         * @return array An array object containing the values in the \System\Collections\IDictionary object.
         */
        public function values() {
            return array_values($this->dictionary);
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            // TODO: Implement getEnumerator() method.
        }


        public function toString() {
            return get_class($this);
        }
    }
}