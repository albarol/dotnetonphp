<?php

namespace System\Collections {

    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ICloneable as ICloneable;

    use \System\Collections\ICollection as ICollection;

    use \System\Collections\Generic\StackEnumerator as StackEnumerator;

    /**
     * Represents a simple last-in-first-out (LIFO) non-generic collection of objects.
     * @access public
     * @name Stack
     * @package System
     * @subpackage Collections
      */
    class Stack implements ICollection, ICloneable {

        private $head = -1;
        private $capacity;
        private $stack;

        /**
         * Initializes a new instance of the System.Collections.Stack class that is empty and has the default initial capacity.
         * @access public
         * @throws ArgumentOutOfRangeException
         * @param object $value initialCapacity -or- ICollection
         */
        public function __construct($value=null) {
            if(is_null($value)) $value = 10;
            if(is_numeric($value)) {
                $this->constructFromNumber($value);
            } else {
                $this->constructFromCollection($value);
            }
        }

        private function constructFromNumber($initialCapacity) {
            if($initialCapacity < 0) throw new ArgumentOutOfRangeException("initialCapacity is less than zero.");
            $this->capacity = $initialCapacity;
            $this->stack = array();
        }

        private function constructFromCollection(ICollection $col) {
            $this->stack = array();
            $enumerator = $col->getEnumerator();
            while($enumerator->moveNext())
                array_push($this->stack, $enumerator->current());
            $this->capacity = sizeof($this->stack);
        }


        /**
         * Removes all objects from the System.Collections.Stack.
         * @access public
         * @return void
         */
        public function clear() {
            unset($this->stack);
            $this->stack = array();
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
         * Determines whether an element is in the System.Collections.Stack.
         * @access public
         * @param object $obj The System.Object to locate in the System.Collections.Stack. The value can be null.
         * @return bool true, if obj is found in the System.Collections.Stack; otherwise, false.
         */
        public function contains($obj) {
            $contains = false;
            for($i = 0; $i < $this->count() && !$contains; $i++) {
                if($this->stack[$i] == $obj)
                    $contains = true;
            }
            return $contains;
        }


        /**
         * Copies the elements of the System.Collections.ICollection to an System.Array, starting at a particular System.Array index.
         * @access public
         * @throws ArgumentNullException|ArgumentOutOfRangeException|ArgumentException
         * @param array $array The one-dimensional System.Array that is the destination of the elements copied from System.Collections.ICollection. The System.Array must have zero-based indexing.
         * @param int $index The zero-based index in array at which copying begins.
         * @return void
         */
        public function copyTo(&$array, $index)
        {
            if(is_null($array)) throw new ArgumentNullException("array is null.");
            if($index < 0 || $index > $this->count()) throw new ArgumentOutOfRangeException("index is less than zero. -or- index greater than size of queue");
            for($i = $index; $i < $this->count(); $i++)
                $array[] = $this->stack[$i];
        }

        /**
         * Gets the number of elements contained in the System.Collections.ICollection.
         * @access public
         * @return int The number of elements contained in the System.Collections.ICollection.
         */
        public function count() {
            return sizeof($this->stack);
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            return new StackEnumerator($this);
        }

        /**
         * Returns the object at the top of the System.Collections.Stack without removing it.2
         * @access public
         * @throws InvalidOperationException
         * @return object The System.Object at the top of the System.Collections.Stack.
         */
        public function peek() {
            if($this->count() == 0) throw new InvalidOperationException("The System.Collections.Stack is empty.");
            return $this->stack[$this->head];
        }

        /**
         * Removes and returns the object at the top of the System.Collections.Stack.
         * @access public
         * @throws InvalidOperationException
         * @return object The System.Object removed from the top of the System.Collections.Stack.
         */
        public function pop() {
            if($this->count() == 0) throw new InvalidOperationException("The System.Collections.Stack is empty.");
            $this->head--;
            return array_pop($this->stack);
        }


         /**
          * Inserts an object at the top of the System.Collections.Stack.
          * @access public
          * @param object $obj The System.Object to push onto the System.Collections.Stack. The value can be null.
          * @return void
          */
        public function push($obj){
            if($this->count() < $this->capacity){
                array_push($this->stack, $obj);
                $this->head++;
            }
        }

        /**
         * Copies the System.Collections.Stack to a new array.
         * @access public
         * @return array A new array containing copies of the elements of the System.Collections.Stack.
         */
        public function toArray() {
            return array_values($this->stack);
        }
    }
}