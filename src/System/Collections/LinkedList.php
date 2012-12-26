<?php

namespace System\Collections {


    /*
     * Class for working with listed lists
     */
    class LinkedList {

        private $_first;
        private $_last;

        /*
         * Add after position
         *
         * @param   int position
         * @param   object  element
         */
        public function addAfter($position, $value) {
            if($position < $this->count() - 1) {
                $node = new LinkedListNode($value);
                $this->_moveToAfter($this->get($position), $node);
            } else {
                $this->addLast($value);
            }
        }

        /*
         * Add before position
         *
         * @param   int position
         * @param   object  element
         */
        public function addBefore($position, $value) {
            if($position > 0) {
                $node = new LinkedListNode($value);
                $this->_moveToBefore($this->get($position), $node);
            } else {
                $this->addFirst($value);
            }
        }

        /*
         * Add first element
         *
         * @param   object  element
         */
        public function addFirst($value) {
            if(!$this->_isFirstElement($value)) {
                $before = new LinkedListNode($value);
                $this->_moveToBefore($this->_first,$before);
                $this->_first = $before;
            } else {
                $this->_addRoot($value);
            }
        }

        /*
         * Add last element
         *
         * @param   object  element
         */
        public function addLast($value) {
            if(!$this->_isFirstElement($value)) {
                $after = new LinkedListNode($value);
                $this->_moveToAfter($this->_last,$after);
                $this->_last = $after;
            } else {
                $this->_addRoot($value);
            }
        }

        /*
         * Find first occurrence of an element
         *
         * @param   object  element
         *
         * @return LinkedListNode
         */
        public function find($value) {
            $current = $this->_first;
            $isFind = null;
            while($current != null && $isFind == null) {
                if($current->getValue() == $value)
                    $isFind = $current;
                $current = $current->getNext();
            };
            return $isFind;
        }

        /*
         * Find last occurrence of an element
         *
         * @param   object  element
         *
         * @return LinkedListNode
         */
        public function findLast($value) {
            $current = $this->_last;
            $isFind = null;
            while($current != null && $isFind == null) {
                if($current->getValue() == $value)
                    $isFind = $current;
                $current = $current->getPrevious();
            };
            return $isFind;
        }

        /*
         * Remove an element
         *
         * @param   int position
         */
        public function remove($position) {
            $current = $this->get($position);
            $this->_removeElement($current);
        }

        /*
         * Remove first occurrence of an element
         *
         * @param   object element
         */
        public function removeFirst($value) {
            $current = $this->find($value);
            if($current == null) throw new InvalidArgumentException("Not find the element.");
            $this->_removeElement($current);
        }

        /*
         * Remove last occurrence of an element
         *
         * @param   object element
         */
        public function removeLast($value) {
            $current = $this->findLast($value);
            if($current == null) throw new InvalidArgumentException("Not find the element.");
            $this->_removeElement($current);
        }

        /*
         * Get element by position
         *
         * @param   int position
         *
         * @return  LinkedListNode
         */
        public function get($position) {
            if($position >= $this->count()) throw new OutOfRangeException("There is no elements that position.");
            $current = $this->_first;
            for($i = 0; $i < $position; $i++) {
                $current = $current->getNext();
            }
            return $current;
        }

        /*
         * Count total elements
         *
         * @return  int
         */
        public function count() {
            $quantity = 0;
            $current = $this->_first;
            while($current != null) {
                $quantity++;
                $current = $current->getNext();
            };
            return $quantity;
        }

        /*
         * Clear Linked List
         */
        public function clear() {
            $this->_first = null;
            $this->_last = null;
        }

        /*
         * Get first element of list
         *
         * @return  LinkedListNode
         */
        public function getFirst() {
            return $this->_first;
        }

        /*
         * Get last element of list
         *
         * @return  LinkedListNode
         */
        public function getLast() {
            return $this->_last;
        }


        /*
         * Remove element
         */
        private function _removeElement($current) {
            $after = $current->getNext();
            $before = $current->getPrevious();
            if($this->count() <= 1) {
                $this->clear();
            } else {
                //move elements
                if($after != null)
                    $after->setPrevious($before);
                if($before != null)
                    $before->setNext($after);
                $current = null;
            }
        }

        /*
         * Verify if is first Element to add in list
         */
        private function _isFirstElement($value) {
            if($this->_first == null)
                return true;
            return false;
        }

        /*
         * Add element to root (first, last)
         */
        private function _addRoot($value) {
             $root = new LinkedListNode($value,$this->_first,$this->_last);
             $this->_first = $root;
             $this->_last = $root;
        }

        /*
         * Moves the front element to the current
         */
        private function _moveToAfter($actual,$after) {
            //set before object
            $next = $actual->getNext();
            $after->setNext($next);
            $after->setPrevious($actual);

            //set previous object
            if($next != null)
                $next->setPrevious($after);

            //set actual object
            $actual->setNext($after);
        }

        /*
         * Move the element behind the current
         */
        private function _moveToBefore($actual,$before) {
            //set before object
            $previous = $actual->getPrevious();
            $before->setPrevious($previous);
            $before->setNext($actual);

            //set previous object
            if($previous != null)
                $previous->setNext($before);

            //set actual object
            $actual->setPrevious($before);
        }
    }
}