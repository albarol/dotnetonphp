<?php

namespace System\Collections\Generic
{

    /**
     * Represents a node in a LinkedList. This class cannot be inherited.
     *
     * @access public
     * @name LinkedListNode
     * @package System
     * @subpackage Collections\Generic
     */
    final class LinkedListNode 
    {
        private $value;
        private $next;
        private $previous;
        private $linkedList;

        /**
         * Initializes a new instance of the LinkedListNode class, containing the specified value.
         *
         * @access public
         * @param object $value The value to contain in the LinkedListNode.
        */
        public function __construct($value)
        {
            $this->value = $value;
        }

        public function equals()
        {

        }

        public function getType()
        {

        }

        public function linkedList(LinkedList $linkedList = null)
        {
            if(!is_null($linkedList) && is_null($this->linkedList))
            {
                $this->linkedList = $linkedList;
            }
            return $this->linkedList;
        }

        public function next(LinkedListNode $node = null, $removeSibling=false)
        {
            if (!is_null($node))
            {
                $this->next = $node;
            }
            elseif ($removeSibling)
            {
                $this->next = $node;
            }
            return $this->next;
        }

        public function previous(LinkedListNode $node = null, $removeSibling=false)
        {
            if (!is_null($node))
            {
                $this->previous = $node;
            }
            elseif ($removeSibling)
            {
                $this->previous = $node;
            }
            return $this->previous;
        }

        public function value()
        {
            return $this->value;
        }

        public function toString()
        {

        }

        public function __toString()
        {
            
        }
    }
}
