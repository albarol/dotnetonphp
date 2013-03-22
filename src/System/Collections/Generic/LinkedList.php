<?php

namespace System\Collections\Generic
{
    
    use System\InvalidOperationException as InvalidOperationException;

    use System\Collections\ICollection as ICollection;
    use System\Collections\IEnumerable as IEnumerable;
    
    use System\Collections\Generic\BaseEnumerator as BaseEnumerator;

    use System\Runtime\Serialization\IDeserializationCallback as IDeserializationCallback;
    use System\Runtime\Serialization\ISerializable as ISerializable;


    /**
     * Represents a doubly linked list.
     * @access public
     * @name LinkedList
     * @package System
     * @subpackage Collections\Generic
     */
    class LinkedList implements ICollection, ISerializable, IDeserializationCallback
    {

        private $first;
        private $last;

        /**
         * Initializes a new instance of the LinkedList class that contains elements copied from the specified IEnumerable and has sufficient capacity to accommodate the number of elements copied.
         * @access public
         * @param \System\Collections\IEnumerable $collection The IEnumerable whose elements are copied to the new LinkedList.
         * 
        */
        public function __construct(IEnumerable $collection = null)
        {
            if(!is_null($collection))
            {
                $enumerator = $collection->getEnumerator();
                while($enumerator->moveNext())
                {
                    $this->add($enumerator->current());
                }
            }
        }

        /**
         * Adds an item at the end of the ICollection.
         * @access public
         * @param object $value The value to add at the end of the ICollection.
        */
        public function add($value)
        {
            $this->addLast($value);
        }

        /**
         * Adds the specified new node after the specified existing node in the LinkedList.
         * @access public
         * @throws \System\InvalidOperationException node is not in the current LinkedList. -or- newNode belongs to another LinkedList.
         * @param \System\Collections\Generic\LinkedListNode $node The LinkedListNode after which to insert newNode.
         * @param \System\Collections\Generic\LinkedListNode $newNode The new LinkedListNode to add to the LinkedList.
         */
        public function addAfter(LinkedListNode $node, LinkedListNode $newNode) 
        {
            if ($node->linkedList() != $this)
            {
                throw new InvalidOperationException("node is not in the current LinkedList.");
            }

            if(!is_null($newNode->linkedList()) && $newNode->linkedList() != $this)
            {
                throw new InvalidOperationException("newNode belongs to another LinkedList.");
            }

            $newNode->linkedList($this);
            $newNode->previous($node);
            $newNode->next($node->next());
            $node->next($newNode);

            if($node == $this->last)
            {
                $this->last = $newNode;
            }
        }

        /**
         * Adds the specified new node before the specified existing node in the LinkedList.
         * @access public
         * @throws \System\InvalidOperationException node is not in the current LinkedList. -or- newNode belongs to another LinkedList.
         * @param \System\Collections\Generic\LinkedListNode $node The LinkedListNode after which to insert newNode.
         * @param \System\Collections\Generic\LinkedListNode $newNode The new LinkedListNode to add to the LinkedList.
         */
        public function addBefore(LinkedListNode $node, LinkedListNode $newNode) 
        {
            if ($node->linkedList() != $this)
            {
                throw new InvalidOperationException("node is not in the current LinkedList.");
            }

            if(!is_null($newNode->linkedList()) && $newNode->linkedList() != $this)
            {
                throw new InvalidOperationException("newNode belongs to another LinkedList.");
            }

            $newNode->linkedList($this);
            $newNode->next($node);
            $newNode->previous($node->previous());
            $node->previous($newNode);

            if($node == $this->first)
            {
                $this->first = $newNode;
            }
        }

        /**
         * Adds a new node containing the specified value at the start of the LinkedList.
         * @access public
         * @param object $value The value to add at the start of the LinkedList.
         * @return \System\Collections\Generic\LinkedListNode The new LinkedListNode containing value.
         */
        public function addFirst($value) 
        {
            $node = new LinkedListNode($value);
            $node->linkedList($this);

            if(is_null($this->last))
            {
                $this->last = $node;
            }

            if (is_null($this->first))
            {
                $this->first = $node;
            }
            else
            {
                $first = $this->first();

                $node->next($first);
                $first->previous($node);
                
                $this->first = $node;
            }
            return $node;
        }

        /**
         * Adds a new node containing the specified value at the end of the LinkedList.
         * @access public
         * @param object $value The value to add at the end of the LinkedList.
         * @return \System\Collections\Generic\LinkedListNode The new LinkedListNode containing value.
         */
        public function addLast($value) 
        {
            $node = new LinkedListNode($value);
            $node->linkedList($this);

            if (is_null($this->first))
            {
                $this->first = $node;
            }

            if(is_null($this->last))
            {
                $this->last = $node;
            }
            else
            {
                $last = $this->last();

                $node->previous($last);
                $last->next($node);
                
                $this->last = $node;
            }
        }

        /**
         * Removes all nodes from the LinkedList.
         * @access public
        */
        public function clear()
        {

        }

        /**
         * The value to locate in the LinkedList. The value can be a null reference
         * @access public
         * @return bool true if value is found in the LinkedList; otherwise, false.
        */
        public function contains() 
        {

        }

        /**
         * Copies the entire LinkedList to a compatible one-dimensional Array, starting at the specified index of the target array.
         * @access public
         * @throws \System\ArgumentNullException array is null.
         * @throws \System\ArgumentOutOfRangeException index is less than zero. -or- index greater than size of list
         * @param int $index The zero-based index in array at which copying begins.
         * @return array The one-dimensional array that is the destination of the elements copied from ICollection. The array must have zero-based indexing.
         */
        public function copyTo($index = 0) 
        {

        }

        /**
         * Gets the number of elements contained in the ICollection.
         * @access public
         * @return int The number of elements contained in the ICollection.
        */
        public function count()
        {
            if (is_null($this->first()))
            {
                return 0;
            }

            $total = 0;
            $current = $this->first();

            do
            {
                $current = $current->next();
                $total++;    
            } while(!is_null($current));

            return $total;
        }

        /**
         * Determines whether the specified object is equal to the current object.
         * @access public
         * @param object $obj The Object to compare with the current Object. 
         * @return bool true if the specified Object is equal to the current Object; otherwise, false.
        */
        public function equals($obj)
        {

        }

        /**
         * Finds the first node that contains the specified value.
         * @access public
         * @param object $value The value to locate in the LinkedList.
         * @return \System\Collections\Generic\LinkedListNode The first LinkedListNode that contains the specified value, if found; otherwise, a null reference
         */
        public function find($value) 
        {
            
        }

        /**
         * Finds the last node that contains the specified value.
         * @access public
         * @param object $value The value to locate in the LinkedList.
         * @return \System\Collections\Generic\LinkedListNode The last LinkedListNode that contains the specified value, if found; otherwise, a null reference
         */
        public function findLast($value) 
        {
            
        }

        /**
         * Gets the first node of the LinkedList.
         * @access public
         * @return \System\Collections\Generic\LinkedListNode The first LinkedListNode of the LinkedList.
        */
        public function first()
        {
            return $this->first;
        }

        /**
         * Returns an enumerator that iterates through the LinkedList.
         * @access public
         * @return \System\Collection\Generic\IEnumerator An LinkedList.Enumerator for the LinkedList. 
        */
        public function getEnumerator()
        {
            if (is_null($this->first()))
            {
                return new BaseEnumerator(array());
            }

            $array = array();
            $current = $this->first();

            do
            {
                array_push($array, $current->value());
                $current = $current->next();
            } while(!is_null($current));

            return new BaseEnumerator($array);
        }

        /**
         * Implements the \System\Runtime\Serialization\ISerializable interface and returns the data needed to serialize the LinkedList instance.
         * @access public
         * @throws \System\ArgumentNullException info is a null reference
         * @param \System\Runtime\Serialization\SerializationInfo $info A SerializationInfo object that contains the information required to serialize the LinkedList instance.
         * @param \System\Runtime\Serialization\StreamingContext $context A StreamingContext object that contains the source and destination of the serialized stream associated with the LinkedList instance.
        */
        public function getObjectData($info, $context)
        {

        }

        /**
         * Gets the Type of the current instance
         * @access public
         * @return \System\Type The Type instance that represents the exact runtime type of the current instance.
        */
        public function getType()
        {

        }

        /**
         * Gets the last node of the LinkedList.
         * @access public
         * @return \System\Collections\Generic\LinkedListNode The last LinkedListNode of the LinkedList.
        */
        public function last()
        {
            return $this->last;
        }

        /**
         * Implements the \System\Runtime\Serialization\ISerializable interface and raises the deserialization event when the deserialization is complete.
         * @access public
         * @throws \System\Runtime\Serialization\SerializationException The SerializationInfo object associated with the current LinkedList instance is invalid.
         * @param object $sender The source of the deserialization event.
        */
        public function onDeserialization($sender)
        {

        }

        /**
         * Removes the first occurrence of a node or value from the LinkedList.
         * @access public
         * @param object $value The value to remove from the LinkedList.
         * @return bool true if the element containing value is successfully removed; otherwise, false. This method also returns false if value was not found in the original LinkedList.
         */
        public function remove($value) 
        {
            
        }

        /**
         * Removes the node at the start of the LinkedList.
         * @access public
         * @throws \System\InvalidOperationException The LinkedList is empty.
         */
        public function removeFirst() 
        {

        }

        /**
         * Removes the node at the end of the LinkedList.
         * @access public
         * @throws \System\InvalidOperationException The LinkedList is empty.
         */
        public function removeLast() 
        {
            
        }
    }
}
