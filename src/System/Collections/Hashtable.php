<?php

namespace System\Collections {

    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentException as ArgumentException;
    use System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;

    use \System\ICloneable as ICloneable;
    use \System\Collections\IDictionary as IDictionary;
    use \System\Runtime\Serialization\ISerializable as ISerializable;
    use \System\Runtime\Serialization\IDeserializationCallback as IDeserializationCallback;
    use System\Collections\Generic\DictionaryEnumerator as DictionaryEnumerator;

    /**
     * Represents a collection of key/value pairs that are organized based on the hash code of the key.
     * @access public
     * @name Hashtable
     * @package System
     * @subpackage Collections
     */
    class Hashtable implements ICloneable, IDictionary, ISerializable, IDeserializationCallback  {

        private $elements = array();
        private $isFixedSize = false;
        private $isReadOnly = false;

        /**
         * Initializes a new, empty instance of the Hashtable class using the default initial capacity, load factor, hash code provider, and comparer.
         * @access public
         * @param object $value The IDictionary object to copy to a new Hashtable object.
         * @param \System\Collections\IEqualityComparer The IEqualityComparer object that defines the hash code provider and the comparer to use with the Hashtable object.
        */
        public function __construct($value = null, IEqualityComparer $equalityComparer = null) {
            if($value instanceof IDictionary):
                foreach($value->keys() as $key):
                    $this->elements[$key] = $value->get($key);
                endforeach;
                $this->isFixedSize = $value->isFixedSize();
                $this->isReadOnly = $value->isReadOnly();
            endif;
        }

        /**
         * Adds an element with the provided key and value to the System.Collections.IDictionary object.
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @throws \System\ArgumentException An element with the same key already exists in the Hashtable.
         * @throws \System\NotSupportedException The Hashtable is read-only. -or- The Hashtable has a fixed size.
         * @param object $key The object to use as the key of the element to add.
         * @param object $value The object to use as the value of the element to add.
         */
        public function add($key, $value) {
            if(is_null($key)):
                throw new ArgumentNullException("key is null.");
            elseif($this->containsKey($key)):
                throw new ArgumentException("An element with the same key already exists in the System.Collections.Hashtable.");
            elseif($this->isFixedSize() || $this->isReadOnly()):
                throw new NotSupportedException("");
            endif;
            $this->elements[$key] = $value;
        }

        /**
         * Removes all elements from the System.Collections.IDictionary object.
         * @access public
         * @throws \System\NotSupportedException The Hashtable is read-only.
         */
        public function clear() {
            if($this->isReadOnly()):
                throw new NotSupportedException("");
            endif;

            unset($this->elements);
            $this->elements = array();
        }

        /**
         * Creates a new object that is a copy of the current instance.
         * @access public
         * @return Object A new object that is a copy of this instance.
         */
        public function cloneObject() {
            return clone $this;
        }

        /**
         * Determines whether the System.Collections.IDictionary object contains an element with the specified key.
         * @access public
         * @throws \System\ArgumentNullException
         * @param object $key The key to locate in the System.Collections.IDictionary object.
         * @return bool true if the System.Collections.IDictionary contains an element with the key; otherwise, false.
         */
        public function contains($key) {
            return $this->containsKey($key);
        }

        /**
         * Determines whether the System.Collections.Hashtable contains a specific key.
         * @access public
         * @throws \System\ArgumentNullException
         * @param $key The key to locate in the System.Collections.Hashtable.
         * @return bool true if the System.Collections.Hashtable contains an element with the specified key; otherwise, false.
         */
        public function containsKey($key) {
            if(is_null($key)):
                throw new ArgumentNullException("key is null.");
            endif;
            return array_key_exists($key, $this->elements);
        }

        /**
         * Determines whether the System.Collections.Hashtable contains a specific value.
         * @access public
         * @param $value The value to locate in the System.Collections.Hashtable. The value can be null.
         * @return bool true if the System.Collections.Hashtable contains an element with the specified value; otherwise, false.
         */
        public function containsValue($value) {
            return array_search($value, $this->elements) !== FALSE;
        }

        /**
         * Copies the elements of the System.Collections.ICollection to an System.Array, starting at a particular System.Array index.
         * @access public
         * @throws ArgumentNullException
         * @throws ArgumentOutOfRangeException
         * @throws ArgumentException
         * @param array $array The one-dimensional System.Array that is the destination of the elements copied from System.Collections.ICollection. The System.Array must have zero-based indexing.
         * @param int $index The zero-based index in array at which copying begins.
         */
        public function copyTo(array &$array, $index=0) {
            if($index < 0):
                throw new ArgumentOutOfRangeException("index is less than zero.");
            endif;
            $current = 0;

            foreach(array_keys($this->elements) as $key) {
                if($current >= $index)
                    $array[$key] = $this->elements[$key];
                $current++;
            }
        }

        /**
         * Gets the number of elements contained in the System.Collections.ICollection.
         * @access public
         * @return int The number of elements contained in the System.Collections.ICollection.
         */
        public function count() {
            return sizeof($this->elements);
        }

        public function equals() { 
            //TODO: Implement this method
        }

        /**
         * Gets or sets the element with the specified key.
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @param object $key The key of the element to get or set.
         * @return object The element with the specified key.
         */
        public function get($key) {
            if(is_null($key)):
                throw new ArgumentNullException("key is null.");
            endif;
            return $this->elements[$key];
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            return new DictionaryEnumerator($this);
        }

        /**
         * Populates a System.Runtime.Serialization.SerializationInfo with the data needed to serialize the target object.
         * @access public
         * @throws \System\Security\SecurityException: The caller does not have the required permission.
         * @param \System\Runtime\Serialization\SerializationInfo $info The SerializationInfo to populate with data.
         * @param \System\Runtime\Serialization\StreamingContext $context The destination for this serialization.
         */
        public function getObjectData($info, $context) {
            // TODO: Implement getObjectData() method.
        }

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object has a fixed size.
         * @access public
         * @return boolean true if the System.Collections.IDictionary object has a fixed size; otherwise, false.
         */
        public function isFixedSize() {
            return $this->isFixedSize;
        }

        /**
         * Gets a value indicating whether the System.Collections.IDictionary object is read-only.
         * @access public
         * @return boolean true if the System.Collections.IDictionary object is read-only; otherwise, false.
         */
        public function isReadOnly() {
            return $this->isReadOnly;
        }

        /**
         * Gets an \System\Collections\ICollection object containing the keys of the System.Collections.IDictionary object.
         * @access public
         * @return \System\Collections\ICollection An ICollection object containing the keys of the \System\Collections\IDictionary object.
         */
        public function keys() {
            return array_keys($this->elements);
        }

        /**
         * Runs when the entire object graph has been deserialized.
         * @access public
         * @param $sender The object that initiated the callback. The functionality for this parameter is not currently implemented.
         * @return void
         */
        public function onDeserialization($sender) {
            // TODO: Implement onDeserialization() method.
        }

        /**
         * Removes the element with the specified key from the System.Collections.IDictionary object.
         * @access public
         * @throws \System\ArgumentNullException key is null.
         * @throws \System\NotSupportedException The Hashtable is readonly -or- has fixedSize
         * @param object $key The key of the element to remove.
         * @return void
         */
        public function remove($key) {
            if(is_null($key)):
                throw new ArgumentNullException("key is null.");
            elseif($this->isReadOnly() || $this->isFixedSize()):
                throw new NotSupportedException("The Hashtable is readonly -or- has fixed size.");
            endif;
            unset($this->elements[$key]);
        }

        /**
         * Set the element with the specified key.
         * @access public
         * @throws \System\ArgumentNullException keys is null
         * @throws \System\NotSupportedException Hashtable is readonly
         * @param object $key The key of the element to get or set.
         * @param object $value The element added
         */
        public function set($key, $value) {
            $this->elements[$key] = $value;
        }

        /**
         * Gets an System.Collections.ICollection object containing the values in the System.Collections.IDictionary object.
         * @access public
         * @return ICollection An System.Collections.ICollection object containing the values in the System.Collections.IDictionary object.
         */
        public function values() {
            return array_values($this->elements);
        }
    }
}