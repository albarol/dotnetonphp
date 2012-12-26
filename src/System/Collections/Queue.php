<?php

namespace System\Collections {

    use System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use System\ArgumentNullException as ArgumentNullException;
    use System\ICloneable as ICloneable;
    use System\Int32 as Int32;
    use System\InvalidOperationException as InvalidOperationException;

    use System\Collections\Generic\QueueEnumerator as QueueEnumerator;

    /**
     * Represents a first-in, first-out collection of objects.
     * @access public
     * @name Queue
     * @package System
     * @subpackage Collections
      */
    class Queue implements ICollection, ICloneable {

        private $size;
        private $queue;
        private $growFactor = 1.0;
        private $position = array('tail' => 0, 'head' => 0);

        /**
         * Initializes a new instance of the System.Collections.Queue class that is empty, has the default initial capacity, and uses the default growth factor.
         * @throws ArgumentNullException
         * @param int $value
         * @param float $growFactor
         */
        public function __construct($value=Int32::MaxValue, $growFactor=1.0) {
            if(is_numeric($value)) {
                $this->createFromNumeric($value, $growFactor);
            } else if($value instanceof ICollection) {
                $this->createFromCollection($value);
            } else {
                throw new \System\ArgumentNullException("value is null.");
            }
        }

        private function createFromNumeric($value, $growFactor) {
            if($value < 0) throw new ArgumentOutOfRangeException("capacity is less than zero.");
            if($growFactor < 1.0 || $growFactor > 10.0) throw new ArgumentOutOfRangeException("growFactor is less than 1.0 or greater than 10.0.");
            $this->size = $value;
            $this->growFactor = $growFactor;
            $this->queue = array();
        }

        private function createFromCollection(ICollection $collection) {
            $this->size = Int32::MaxValue;
            $this->queue = array();
            $enumerator = $collection->getEnumerator();
            while($enumerator->moveNext()) {
                $this->enqueue($enumerator->current());
            }
        }

        /**
         * Removes all objects from the System.Collections.Queue.
         * @return void
         */
        public function clear() {
            $this->queue = array();
            $this->position['tail'] = 0;
            $this->position['head'] = 0;
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
         * Determines whether an element is in the System.Collections.Queue.
         * @access public
         * @param $obj The System.Object to locate in the System.Collections.Queue. The value can be null.
         * @return bool true if obj is found in the System.Collections.Queue; otherwise, false.
         */
        public function contains($obj) {
            $contains = false;
            $total = $this->count() + $this->position['tail'];
            for($i = $this->position['tail']; $i < $total && !$contains; $i++) {
                if($this->queue[$i] == $obj)
                    $contains = true;
            }
            return $contains;
        }

        public function copyTo(array &$array, $index=0) {
            if(is_null($array)) throw new ArgumentNullException("array is null.");
            if($index < 0 || $index > $this->count()) throw new ArgumentOutOfRangeException("index is less than zero. -or- index greater than size of queue");
            for($i = $index; $i < $this->count(); $i++)
                $array[] = $this->queue[$i];
        }

        /**
         * Gets the number of elements contained in the System.Collections.Queue.
         * @access public
         * @return int The number of elements contained in the System.Collections.Queue.
         */
        public function count() {
            return sizeof($this->queue);
        }


        /**
         * Adds an object to the end of the System.Collections.Queue.
         * @access public 
         * @param object $obj The object to add to the System.Collections.Queue. The value can be null.
         * @return void
         */
        public function enqueue($obj) {
            if($this->sizeOfQueue() < $this->size) {
                $this->queue[$this->position['head']++] = $obj;
            }
        }

        /**
         * Method do measure real size of queue
         * @return int
         */
        private function sizeOfQueue() {
            return $this->count() * $this->growFactor;
        }


        /**
         * Returns an enumerator that iterates through the System.Collections.Queue.
         * @return IEnumerator An System.Collections.IEnumerator for the System.Collections.Queue.
         */
        public function getEnumerator() {
            return new QueueEnumerator($this);
        }


        /**
         * Removes and returns the object at the beginning of the System.Collections.Queue.
         * @access public
         * @throws InvalidOperationException 
         * @return object The object that is removed from the beginning of the System.Collections.Queue.
         */
        public function dequeue() {
            if($this->count() == 0) throw new InvalidOperationException("The System.Collections.Queue is empty.");
            $current = $this->position['tail'];
            $result = $this->queue[$this->position['tail']++];
            unset($this->queue[$current]);
            return $result;
        }

        /**
         * Returns the object at the beginning of the System.Collections.Queue without removing it.
         * @access public
         * @throws InvalidOperationException
         * @return The object at the beginning of the System.Collections.Queue.
         */
        public function peek() {
            if($this->count() == 0)  throw new InvalidOperationException("The System.Collections.Queue is empty.");
            return $this->queue[$this->position['tail']];
        }

        /**
         * Copies the System.Collections.Queue elements to a new array.
         * @access public
         * @return array A new array containing elements copied from the System.Collections.Queue.
         */
        public function toArray() {
            return array_values($this->queue);
        }

        /**
         * Sets the capacity to the actual number of elements in the System.Collections.Queue.
         * @return void
         */
        public function trimToSize() {
            $this->size = $this->sizeOfQueue();
        }
    }
}