<?php

namespace System\Collections {

    // use \System\Xml\ArrayList as ArrayList;

    /**
     * Provides the abstract base class for a strongly typed collection.
     * @access public
     * @name CollectionBase
     * @package System
     * @subpackage Collections
     */
    abstract class CollectionBase implements IList {

        /**
         * @var Gets an ArrayList containing the list of elements in the CollectionBase instance.
         */
        protected $innerList;

        /**
         * @var type of collection
         */
        private $typeOf;


        /**
         * Initializes a new instance of the CollectionBase class.
         * @access protected
         * @param $typeName
         */
        protected function __construct($typeName) {
            $this->innerList = new ArrayList;
            $this->typeOf = str_replace('\\', '', strtolower($typeName));
        }

        /**
         * Adds an item to the System.Collections.IList.
         * @access public
         * @param object $value The System.Object to add to the System.Collections.IList.
         * @return int The position into which the new element was inserted.
         */
        public function add($value) {
            if($this->validateType($value))
                $this->innerList->add($value);
        }

        /**
         * Removes all items from the System.Collections.IList.
         * @access public
         * @throws NotSupportedException
         * @return void
         */
        public function clear() {
            $this->innerList->clear();
        }

        /**
         * Determines whether the System.Collections.IList contains a specific value.
         * @access public
         * @param object $value The System.Object to locate in the System.Collections.IList.
         * @return bool true if the System.Object is found in the System.Collections.IList; otherwise, false.
         */
        public function contains($value) {
            return $this->innerList->contains($value);
        }

        /**
         * Copies the elements of the System.Collections.ICollection to an System.Array, starting at a particular System.Array index.
         * @access public
         * @throws ArgumentNullException|ArgumentOutOfRangeException|ArgumentException
         * @param array $array The one-dimensional System.Array that is the destination of the elements copied from System.Collections.ICollection. The System.Array must have zero-based indexing.
         * @param int $index The zero-based index in array at which copying begins.
         * @return void
         */
        public function copyTo($index=0) {
            $this->innerList->copyTo($index);
        }

        /**
         * Gets the number of elements contained in the System.Collections.ICollection.
         * @access public
         * @return int The number of elements contained in the System.Collections.ICollection.
         */
        public function count() {
            return $this->innerList->count();
        }


        /**
         * Allows an Object to attempt to free resources and perform other cleanup operations before the Object is reclaimed by garbage collection.
         * @access public
         * @return void
         */
        protected function finalize() {
            //TODO: Implement finalize() method.
        }

        /**
         * Gets the element at the specified index.
         * @access public
         * @throws System.ArgumentOutOfRangeException
         * @param int $index The zero-based index of the element to get
         * @return The element at the specified index.
         */
        public function get($index) {
            return $this->innerList->get($index);
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            return $this->innerList->getEnumerator();
        }

        /**
         * Determines the index of a specific item in the System.Collections.IList.
         * @access public
         * @param object $value The System.Object to locate in the System.Collections.IList.
         * @return The index of value if found in the list; otherwise, -1.
         */
        public function indexOf($value) {
            return $this->innerList->indexOf($value);
        }

        /**
         * Inserts an item to the System.Collections.IList at the specified index.
         * @access public
         * @throws ArgumentOutOfRangeException|NotSupportedException|NullReferenceException
         * @param $index The zero-based index at which value should be inserted.
         * @param $value The System.Object to insert into the System.Collections.IList.
         * @return void
         */
        public function insert($index, $value) {
            $this->innerList->insert($index, $value);
        }

        /**
         * Gets an IList containing the list of elements in the CollectionBase instance.
         * @access protected
         * @return IList
         */
        protected function getList() {
            return $this->innerList;
        }

        /**
         * Performs additional custom processes when clearing the contents of the CollectionBase instance.
         * @access protected
         * @return void
         */
        protected function onClear() {
            // TODO: Implement onClear() method.
        }

        /**
         * Performs additional custom processes after clearing the contents of the CollectionBase instance.
         * @access protected
         * @return void
         */
        protected function onClearComplete() {
            // TODO: Implement onClearComplete() method.
        }

        /**
         * Performs additional custom processes before inserting a new element into the CollectionBase instance.
         * @access protected
         * @param $index The zero-based index at which to insert value.
         * @param $value The new value of the element at index.
         * @return void
         */
        protected function onInsert($index, $value) {
            // TODO: Implement onInsert() method.
        }

        /**
         * Performs additional custom processes after inserting a new element into the CollectionBase instance.
         * @access protected
         * @param $index The zero-based index at which to insert value.
         * @param object $value The new value of the element at index.
         * @return void
         */
        protected function onInsertComplete($index, $value) {
            // TODO: Implement onInsertComplete() method.
        }


        /**
         * Performs additional custom processes when removing an element from the CollectionBase instance.
         * @access protected
         * @param $index The zero-based index at which value can be found.
         * @param $value The value of the element to remove from index.
         * @return void
         */
        protected function onRemove($index, $value) {
            // TODO: Implement onRemove() method.
        }

        /**
         * Performs additional custom processes after removing an element from the CollectionBase instance.
         * @access protected
         * @param $index The zero-based index at which value can be found.
         * @param $value The value of the element to remove from index.
         * @return void
         */
        protected function onRemoveComplete($index, $value) {
            // TODO: Implement onRemoveComplete() method.
        }


        /**
         * Performs additional custom processes before setting a value in the CollectionBase instance.
         * @access protected
         * @param $index The zero-based index at which oldValue can be found.
         * @param $oldValue The value to replace with newValue.
         * @param $newValue The new value of the element at index.
         * @return void
         */
        protected function onSet($index, $oldValue, $newValue) {
            //TODO: Implement onSet() method.
        }

        /**
         * Performs additional custom processes after setting a value in the CollectionBase instance.
         * @access protected
         * @param $index The zero-based index at which oldValue can be found.
         * @param $oldValue The value to replace with newValue.
         * @param $newValue The new value of the element at index.
         * @return void
         */
        protected function onSetComplete($index, $oldValue, $newValue) {
            //TODO: Implement onSetComplete() method.
        }


        /**
         * Performs additional custom processes when validating a value.
         * @access protected
         * @param $value The object to validate.
         * @return void
         */
        protected function onValidate($value) {
            //TODO: Implement onValidate() method.
        }


        /**
         * Removes the first occurrence of a specific object from the System.Collections.IList.
         * @access public
         * @throws NotSupportedException
         * @param object $value The System.Object to remove from the System.Collections.IList.
         * @return void
         */
        public function remove($value) {
            $this->InnerList->remove($value);
        }

        /**
         * Removes the System.Collections.IList item at the specified index.
         * @access public
         * @throws ArgumentOutOfRangeException|NotSupportedException
         * @param int $index The zero-based index of the item to remove.
         * @return void
         */
        public function removeAt($index) {
            $this->InnerList->removeAt($index);
        }

        /**
         * Gets a value indicating whether the System.Collections.IList has a fixed size.
         * @access public
         * @return true if the System.Collections.IList has a fixed size; otherwise, false.
         */
        public function isFixedSize() {
            return $this->InnerList->isFixedSize();
        }

        /**
         * Gets a value indicating whether the System.Collections.IList is read-only.
         * @access public
         * @return bool true if the System.Collections.IList is read-only; otherwise, false.
         */
        public function isReadOnly() {
            return $this->InnerList->isReadOnly();
        }


        private function validateType($object) {
            try {
                $type = str_replace('\\', '', strtolower(get_class($object)));
                return $type == $this->typeOf;
            } catch(\Exception $e) {
                return false;
            }
        }
    }
}
