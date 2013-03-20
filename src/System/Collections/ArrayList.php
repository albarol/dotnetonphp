<?php

namespace System\Collections { 

    use \System\IComparable as IComparable;
    use \System\ICloneable as ICloneable;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentException as ArgumentException;
    use \System\NotSupportedException as NotSupportedException;
    use \System\Math as Math;
    
    use \System\Collections\Generic\ArrayListEnumerator as ArrayListEnumerator;


    class ArrayList implements ICloneable, IList {

        private $elements = array();
        private $capacity;
        private $isReadOnly;
        private $isFixedSize;

        /**
         * Initializes a new instance of the ArrayList class that contains elements copied from the specified collection and that has the same initial capacity as the number of elements copied.
         * @throws \System\ArgumentException capacity is less than zero.
         * @throws \System\ArgumentNullException value is null.
         * @param int $value The ICollection whose elements are copied to the new list.
         */
        public function __construct($value = 10) {
            if(is_numeric($value)):
                $this->constructFromNumber($value);
            elseif($value instanceof ICollection):
                $this->constructFromCollection($value);
            else:
                throw new ArgumentNullException("value is null.");
            endif;
        }

        private function constructFromNumber($value) {
            if($value < 0):
                throw new ArgumentOutOfRangeException("capacity is less than zero.");
            endif;
            $this->capacity = $value;
        }

        private function constructFromCollection(ICollection $value) {
            $enumerator = $value->getEnumerator();
            while($enumerator->moveNext()) {
                array_push($this->elements, $enumerator->current());
            }
            $this->capacity = $value->count();
        }

        /**
         * Creates an \System\Collections\ArrayList wrapper for a specific \System\Collections\IList.
         * @access public
         * @throws \System\ArgumentNullException list is null.
         * @param \System\Collections\IList $list The \System\Collections\IList to wrap.
         * @return ArrayList The \System\Collections\ArrayList wrapper around the \System\Collections\IList.
         */
        public static function adapter(IList $list) {
            $array = new ArrayList();
            $array->addRange($list);
            return $array;
        }

        /**
         * Adds an object to the end of the ArrayList.
         * @access public
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only. -or-  The \System\Collections\ArrayList has a fixed size.
         * @param object $value The Object to be added to the end of the ArrayList. The value can be null.
         * @return int The ArrayList index at which the value has been added.
         */
        public function add($value) {
            if(!$this->canWrite()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only. -or-  The \System\Collections\ArrayList has a fixed size.");
            endif;
            array_push($this->elements, $value);
            return $this->count() - 1;
        }

        /**
         * Adds the elements of an \System\Collections\ICollection to the end of the \System\Collections\ArrayList.
         * @access public
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only. -or-  The \System\Collections\ArrayList has a fixed size.
         * @param \System\Collections\ICollection $c The \System\Collections\ICollection whose elements should be added to the end of the \System\Collections\ArrayList. The collection itself cannot be null, but it can contain elements that are null.
         */
        public function addRange(ICollection $c) {
            if(!$this->canWrite()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only. -or-  The \System\Collections\ArrayList has a fixed size.");
            endif;
            $this->addCollections($c);
        }


        /**
         * Searches the entire sorted \System\Collections\ArrayList for an element using the specified comparer and returns the zero-based index of the element.
         * @access public
         * @param $value The System.Object to locate. The value can be null.
         * @param $index The zero-based starting index of the range to search.
         * @param $count The length of the range to search.
         * @param \System\IComparable $comparer The \System\Collections\IComparer implementation to use when comparing elements. -or- null to use the default comparer that is the System.IComparable implementation of each element.
         * @return int The zero-based index of value in the sorted \System\Collections\ArrayList, if value is found; otherwise, a negative number, which is the bitwise complement of the index of the next element that is larger than value or, if there is no larger element, the bitwise complement of \System\Collections\ArrayList.Count.
         */
        public function binarySearch($value, $index=null, $count=null, IComparable $comparer=null) {
            return 0;
        }


        /**
         * Gets or sets the number of elements that the \System\Collections\ArrayList can contain.
         * @param int $value sets the number of elements
         * @throws \System\ArgumentOutOfRangeException capacity is set to a value that is less than count.
         * @return int The number of elements that the ArrayList can contain.
         */
        public function capacity($value=null) {
            if(is_numeric($value)):
                if($value < $this->count()):
                    throw new ArgumentOutOfRangeException("capacity is set to a value that is less than \System\Collections\ArrayList.Count.");
                endif;
                $this->capacity = $value;
            elseif($this->capacity < $this->count()):
                $this->capacity = $this->count();
            endif;
            return $this->capacity;
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
         * Removes all items from the \System\Collections\IList.
         * @access public
         * @throws \System\NotSupportedException The ArrayList is read-only. -or-  The ArrayList has a fixed size.
         * @return void
         */
        public function clear() {
            if(!$this->canWrite()):
                throw new NotSupportedException("The ArrayList is read-only. -or-  The ArrayList has a fixed size.");
            endif;
            unset($this->elements);
            $this->elements = array();
        }

        /**
         * Determines whether the \System\Collections\IList contains a specific value.
         * @access public
         * @param object $value The object to locate in the \System\Collections\IList.
         * @return bool true if the object is found in the \System\Collections\IList; otherwise, false.
         */
        public function contains($value) {
            return ($this->indexOf($value) >= 0) ? true : false;
        }

        /**
         * Copies the elements of the \System\Collections\ICollection to an \System\Array, starting at a particular \System\Array index.
         * @access public
         * @throws \System\ArgumentNullException array is null.
         * @throws \System\ArgumentOutOfRangeException index is less than zero. -or- index greater than size of list
         * @param int $index The zero-based index in array at which copying begins.
         * @return array The one-dimensional array that is the destination of the elements copied from ICollection. The array must have zero-based indexing.
         */
        public function copyTo($index=0) 
        {
            if($index < 0 || $index > $this->count())
            {
                throw new ArgumentOutOfRangeException("Index is less than zero. -or- index greater than size of list");
            }

            $array = array();
            for($i = $index; $i < $this->count(); $i++)
            {
                $array[] = $this->elements[$i];
            }

            return $array;
        }

        /**
         * Gets the number of elements contained in the \System\Collections\ICollection.
         * @access public
         * @return int The number of elements contained in the \System\Collections\ICollection.
         */
        public function count() {
            return sizeof($this->elements);
        }

        /**
         * Returns an \System\Collections\IList wrapper with a fixed size.
         * @static
         * @access public
         * @param \System\Collections\IList $list the \System\Collections\IList to wrap.
         * @return \System\Collections\ArrayList an \System\Collections\IList wrapper with a fixed size.
         */
        public static function fixedSize(IList $list) {
            $array = new ArrayList($list);
            $array->isFixedSize = true;
            return $array;
        }

        /**
         * Gets the element at the specified index.
         * @access public
         * @throws \System\ArgumentOutOfRangeException Index less than zero -or- index greater than max value.
         * @param int $index The zero-based index of the element to get
         * @return object The element at the specified index.
         */
        public function get($index) {
            if(!$this->isValidIndex($index)):
                throw new ArgumentOutOfRangeException("index less than zero -or- index greater than max value.");
            endif;
            return $this->elements[$index];
        }


        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return \System\Collections\IEnumerator An \System\Collections\IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            return new ArrayListEnumerator($this);
        }


        /**
         * Returns an \System\Collections\ArrayList which represents a subset of the elements in the source \System\Collections\ArrayList.
         * @access public
         * @throws \System\ArgumentOutOfRangeException index less than zero -or- index greater than max value.
         * @throws \System\ArgumentException index and count do not denote a valid range of elements in the \System\Collections\ArrayList
         * @param int $index The zero-based \System\Collections\ArrayList index at which the range starts.
         * @param int $count The number of elements in the range.
         * @return \System\Collections\ArrayList An \System\Collections\ArrayList which represents a subset of the elements in the source \System\Collections\ArrayList.
         */
        public function getRange($index, $count) {
            
            if(!$this->isValidIndex($index) || $count < 0) {
                throw new ArgumentOutOfRangeException("index less than zero -or- index greater than max value.");
            }

            if(!$this->isValidRange($index, $count)) {
                throw new ArgumentException("index and count do not denote a valid range of elements in the \System\Collections\ArrayList");
            }
            
            $list = new ArrayList();
            for($i = 0; $i < $count; $i++)
                $list->add($this->elements[$index + $i]);
            return $list;
        }

        /**
         * Determines the index of a specific item in the \System\Collections\IList.
         * @abstract
         * @access public
         * @throws \System\ArgumentOutOfRangeException StartIndex is outside the range of valid indexes for the \System\Collections\ArrayList -or- count is less than zero. -or- startIndex and count do not specify a valid section in the \System\Collections\ArrayList.
         * @param object $value The object to locate in the \System\Collections\IList.
         * @param int $startIndex The zero-based starting index of the search.
         * @param int $count The number of elements in the section to search.
         * @return The index of value if found in the list; otherwise, -1.
         */
        public function indexOf($value, $startIndex=0, $count=null) {
            if(!$this->isValidIndex($startIndex)):
                throw new ArgumentOutOfRangeException("startIndex is outside the range of valid indexes for the \System\Collections\ArrayList.  -or- count is less than zero.");
            endif;


            if(is_null($count)) {
                $count = (($this->count() - 1) - $startIndex); // rearrange count if is null
            }

            if(!$this->isValidRange($startIndex, $count)) :
                throw new ArgumentOutOfRangeException("startIndex and count do not specify a valid section in the \System\Collections\ArrayList");
            endif;

            $index = -1;
            for($i = 0; $i <= $count && $index == -1; $i++) {
                $currentIndex = $startIndex + $i;
                if($this->elements[$currentIndex] == $value)
                    $index = $currentIndex;
            }
            return $index;
        }

        /**
         * Inserts an item to the \System\Collections\IList at the specified index.
         * @access public
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only. -or-  The System\Collections\ArrayList has a fixed size.
         * @throws \System\ArgumentOutOfRangeException Index less than zero -or- index greater than max value.
         * @param int $index The zero-based index at which value should be inserted.
         * @param object $value The object to insert into the \System\Collections\IList.
         * @return void
         */
        public function insert($index, $value) {
            if(!$this->canWrite()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only. -or- The System\Collections\ArrayList has a fixed size.");
            endif;
            if(!$this->isValidIndex($index)):
                throw new ArgumentOutOfRangeException("index less than zero -or- index greater than max value.");
            endif;
            array_splice($this->elements, $index, 0, $value);
        }


        /**
         * Inserts the elements of a collection into the \System\Collections\ArrayList at the specified index.
         * @access public
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only. -or- The \System\Collections\ArrayList has a fixed size.
         * @throws \System\ArgumentOutOfRangeException index less than zero -or- index greater than max value.
         * @param int $index The zero-based index at which the new elements should be inserted.
         * @param \System\Collections\ICollection $c The \System\Collections\ICollection whose elements should be inserted into the \System\Collections\ArrayList. The collection itself cannot be null, but it can contain elements that are null.
         * @return void
         */
        public function insertRange($index, ICollection $c) {
            if(!$this->canWrite()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only. -or-  The \System\Collections\ArrayList has a fixed size.");
            endif;
            if(!$this->isValidIndex($index)):
                throw new ArgumentOutOfRangeException("Index less than zero -or- index greater than max value.");
            endif;
            $enumerator = $c->getEnumerator();
            while($enumerator->moveNext()){
                array_splice($this->elements, $index, 0, $enumerator->current());
                $index++;
            }
        }

        /**
         * Gets a value indicating whether the \System\Collections\ArrayList has a fixed size.
         * @access public
         * @return bool true if the \System\Collections\ArrayList has a fixed size; otherwise, false. The default is false.
         */
        public function isFixedSize() {
            return $this->isFixedSize
;
        }

        /**
         * Gets a value indicating whether the \System\Collections\IList is read-only.
         * @access public
         * @return bool true if the \System\Collections\IList is read-only; otherwise, false.
         */
        public function isReadOnly() {
            return $this->isReadOnly;
        }

        /**
         * Searches for the specified object and returns the zero-based index of the last occurrence within the range of elements in the \System\Collections\ArrayList that contains the specified number of elements and ends at the specified index.
         * @access public
         * @throws \System\ArgumentOutOfRangeException startIndex is outside the range of valid indexes for the \System\Collections\ArrayList. -or- count is less than zero. -or- startIndex and count do not specify a valid section in the \System\Collections\ArrayList.
         * @param object $value The System.Object to locate in the \System\Collections\ArrayList. The value can be null.
         * @param int $startIndex The zero-based starting index of the backward search.
         * @param int $count The number of elements in the section to search.
         * @return The zero-based index of the last occurrence of value within the range of elements in the \System\Collections\ArrayList that contains count number of elements and ends at startIndex, if found; otherwise, -1.
         */
        public function lastIndexOf($value, $startIndex=null, $count=null) {
            if(!$this->isValidIndex($startIndex)):
                throw new ArgumentOutOfRangeException("startIndex is outside the range of valid indexes for the \System\Collections\ArrayList. -or- count is less than zero.");
            endif;

            if(is_null($count)) {
                $count = ($this->count() - 1) - $startIndex;
            }

            if(!$this->isValidRange($startIndex, $count)):
                throw new ArgumentOutOfRangeException("startIndex and count do not specify a valid section in the \System\Collections\ArrayList.");
            endif;

            $index = -1;
            for($i = 0; $i <= $count; $i++) {
                $currentIndex = $startIndex + $i;
                if($this->elements[$currentIndex] == $value)
                    $index = $currentIndex;
            }
            return $index;
        }


        /**
         * Returns a read-only \System\Collections\IList wrapper.
         * @static
         * @param \System\Collections\IList $list The \System\Collections\IList to wrap.
         * @return \System\Collections\ArrayList A read-only \System\Collections\IList wrapper around list.
         */
        public static function readOnly(IList $list) {
            $array = new ArrayList($list);
            $array->isReadOnly = true;
            return $array;
        }


        /**
         * Removes the first occurrence of a specific object from the \System\Collections\IList.
         * @access public
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only. -or- The \System\Collections\ArrayList has a fixed size.
         * @param object $value The System.Object to remove from the \System\Collections\IList.
         * @return void
         */
        public function remove($value) {
            if(!$this->canWrite()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only. -or- The \System\Collections\ArrayList has a fixed size.");
            endif;
            $index = $this->indexOf($value);
            if($index >= 0)
                $this->removeAt($index);
        }

        /**
         * Removes the \System\Collections\IList item at the specified index.
         * @access public
         * @throws \System\ArgumentOutOfRangeException index is less than zero.-or- index is greater than count.
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only. -or- The \System\Collections\ArrayList has a fixed size.
         * @param int $index The zero-based index of the item to remove.
         * @return void
         */
        public function removeAt($index) {
            if(!$this->canWrite()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only. -or- The \System\Collections\ArrayList has a fixed size.");
            endif;

            if(!$this->isValidIndex($index)):
                throw new ArgumentOutOfRangeException("index is less than zero.-or- index is greater than count.");
            endif;
            unset($this->elements[$index]);
            $this->elements = array_values($this->elements);
        }

        /**
         * Removes a range of elements from the \System\Collections\ArrayList.
         * @access public
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only. -or-  The \System\Collections\ArrayList has a fixed size.
         * @throws \System\ArgumentOutOfRangeException index less than zero -or- index greater than max value.
         * @throws ArgumentException index and count do not denote a valid range of elements in the \System\Collections\ArrayList.
         * @param int $index The zero-based starting index of the range of elements to remove.
         * @param int $count The number of elements to remove.
         * @return void
         */
        public function removeRange($index, $count) {
            if(!$this->canWrite()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only. -or- The \System\Collections\ArrayList has a fixed size.");
            endif;
            if(!$this->isValidIndex($index) || $count < 0):
                throw new ArgumentOutOfRangeException("index less than zero -or- index greater than max value.");
            endif;
            if(!$this->isValidRange($index, $count)):
                throw new ArgumentException("index and count do not denote a valid range of elements in the \System\Collections\ArrayList.");
            endif;
            for($i = 0; $i <= $count; $i++)
                unset($this->elements[$index + $i]);
            $this->elements = array_values($this->elements);
        }

        /**
         * Returns an \System\Collections\ArrayList whose elements are copies of the specified value.
         * @access public
         * @throws \System\ArgumentOutOfRangeException count is less than zero.
         * @param object $value The System.Object to copy multiple times in the new \System\Collections\ArrayList. The value can be null.
         * @param int $count The number of times value should be copied.
         * @return ArrayList An \System\Collections\ArrayList with count number of elements, all of which are copies of value.
         */
        public static function repeat($value, $count) {
            if($count < 0):
                throw new ArgumentOutOfRangeException("count is less than zero.");
            endif;
            $list = new ArrayList();
            for($i = 0; $i < $count; $i++)
                $list->add($value);
            return $list;
        }

        /**
         * Reverses the order of the elements in the entire \System\Collections\ArrayList.
         * @access public
         * @throws \System\ArgumentOutOfRangeException The \System\Collections\ArrayList is read-only.
         * @throws \System\ArgumentException index and count do not denote a valid range of elements in the \System\Collections\ArrayList.
         * @throws \System\NotSupportedException index is less than zero. -or - count is less than zero.
         * @param int $index The zero-based starting index of the range to reverse.
         * @param int $count The number of elements in the range to reverse.
         * @return void
         */
        public function reverse($index=null, $count=null) {
            if($this->isReadOnly()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only.");
            endif;
            if(is_null($index) || is_null($count)) {
                $this->reverseAll();
            } else {
                $this->reverseRange($index, $count);
            }
        }

        private function reverseAll() {
            $this->elements = array_reverse($this->elements);
        }

        private function reverseRange($index, $count) {
            if(!$this->isValidRange($index, $count)):
                throw new ArgumentException("index and count do not denote a valid range of elements in the \System\Collections\ArrayList.");
            endif;
            if(!$this->isValidIndex($index) || !$this->isValidIndex($count)):
                throw new ArgumentOutOfRangeException("index is less than zero. -or - count is less than zero.");
            endif;

            $length = round(($index + $count)/ 2);
            for(; $index < $length;):
                $aux = $this->elements[$count-1];
                $this->elements[$count-1] = $this->elements[$index];
                $this->elements[$index] = $aux;
                $count--;
                $index++;
            endfor;
        }

        /**
         * Sorts the elements in the entire \System\Collections\ArrayList using the System.IComparable implementation of each element.
         * @access public
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only.
         * @param \System\IComparer $comparer The \System\Collections\IComparer implementation to use when comparing elements. -or-  null to use the System.IComparable implementation of each element.
         * @return void
         */
        public function sort(IComparer $comparer=null) {
            if($this->isReadOnly()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only.");
            endif;
            if($comparer instanceof IComparer) {
                $this->sortComparable($comparer);
            } else {
                sort($this->elements);
            }
        }

        private function sortComparable(IComparer $comparer) {
            //TODO: Implement comparer
        }

        /**
         * Copies the elements of a collection over a range of elements in the \System\Collections\ArrayList.
         * @access public
         * @throws \System\ArgumentOutOfRangeException index is less than zero. -or-  index plus the number of elements in c is greater than \System\Collections\ArrayList.Count.
         * @throws \System\NotSupportedException The \System\Collections\ArrayList is read-only.
         * @param int $index The zero-based \System\Collections\ArrayList index at which to start copying the elements of c.
         * @param \System\Collections\ICollection $c The \System\Collections\ICollection whose elements to copy to the \System\Collections\ArrayList. The collection itself cannot be null, but it can contain elements that are null.
         * @return void
         */
        public function setRange($index, $c) {
            if($this->isReadOnly()):
                throw new NotSupportedException("The \System\Collections\ArrayList is read-only.");
            endif;
            if($index < 0 || ($index + $c->count()) > $this->count()):
                throw new ArgumentOutOfRangeException("index is less than zero. -or-  index plus the number of elements in c is greater than \System\Collections\ArrayList.Count.");
            endif;
            $enumerator = $c->getEnumerator();
            while($enumerator->moveNext()) {
                $this->elements[$index] = $enumerator->current();
                $index++;
            }
        }

        /**
         * Copies the elements of the \System\Collections\ArrayList to a new System.Object array.
         * @access public
         * @return array An object array containing copies of the elements of the \System\Collections\ArrayList.
         */
        public function toArray() {
            return array_values($this->elements);
        }


        /**
         * Sets the capacity to the actual number of elements in the ArrayList.
         * @access public
         * @throws \System\NotSupportedException The ArrayList is read-only. -or- The ArrayList has a fixed size.
         */
        public function trimToSize() {
            if(!$this->canWrite()):
                throw new NotSupportedException("The ArrayList is read-only. -or- The ArrayList has a fixed size.");
            endif;
            $this->capacity($this->count());
        }

        private function addCollections(ICollection $col) {
            $enumerator = $col->getEnumerator();
            while($enumerator->moveNext()) {
                $this->add($enumerator->current());
            }
        }

        private function canWrite() {
            return !$this->isReadOnly() && !$this->isFixedSize();
        }

        private function isValidIndex($index) {
            if($this->count() == 0)
                return $index == 0;
            return $index >= 0 && $index < $this->count();
        }

        private function isValidRange($index, $count) {
            return ($index + $count) < $this->count();
        }
    }
}