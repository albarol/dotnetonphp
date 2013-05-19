<?php

use \System\Collections\Generic\LinkedList as LinkedList;
use \System\Collections\Generic\LinkedListNode as LinkedListNode;

class LinkedListTestCase extends PHPUnit_Framework_TestCase 
{
    
    /**
     * @test
     */
    public function Construct_ShouldConstructLinkedList() 
    {
        # Arrange:
        # Act:
        $linkedList = new LinkedList;
    
        # Assert:
        $this->assertNotNull($linkedList);
    }

    /**
     * @test
     */
    public function Construct_ShouldConstructLinkedListFromCollection() 
    {
        # Arrange:
        $linkedList = new LinkedList;
        $linkedList->add(1);

        # Act:
        $new_linkedlist = new LinkedList($linkedList);
    
        # Assert:
        $this->assertEquals($linkedList->count(), $new_linkedlist->count());
    }

    /**
     * @test
     */
    public function Add_ShouldAppendLinkedListNode()
    { 
        # Arrange:
        $linkedList = new LinkedList;
    
        # Act:
        $linkedList->add(1);
    
        # Assert:
        $this->assertEquals(1, $linkedList->count());
    }


    /**
     * @test
     */
    public function Add_ShouldAppendLinkedListNodeInLastPosition() 
    {
        # Arrange:
        $linkedList = new LinkedList;
    
        # Act:
        $linkedList->add(1);
        $linkedList->add(2);
    
        # Assert:
        $this->assertEquals(2, $linkedList->last()->value());
    }

    /**
     * @test
     */
    public function Add_ShouldBeFirstWhenLinkedListIsEmpty() 
    {
        # Arrange:
        $linkedList = new LinkedList;
    
        # Act:
        $linkedList->add(1);
    
        # Assert:
        $this->assertEquals(1, $linkedList->first()->value());
    }

    /**
     * @test
     */
    public function Add_ShouldBeLastWhenLinkedListIsEmpty() 
    {
        # Arrange:
        $linkedList = new LinkedList;
    
        # Act:
        $linkedList->add(1);
    
        # Assert:
        $this->assertEquals(1, $linkedList->last()->value());
    }

    /**
     * @test
     * @expectedException \System\InvalidOperationException
     */
    public function AddAfter_ThrowsExceptionWhenNodeNotBelongsToLinkedList() 
    {
        # Arrange:
        $node = new LinkedListNode(1);
        $linkedList = new LinkedList;
    
        # Act:
        $linkedList->addAfter($node, new LinkedListNode(1));
    }

     /**
     * @test
     * @expectedException \System\InvalidOperationException
     */
    public function AddAfter_ThrowsExceptionWhenNewNodeBelongsToAnotherLinkedList() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l2 = new LinkedList;
        $l2->add(2);
        
        # Act:
        $l1->addAfter($l1->first(), $l2->first());
    }

    /**
     * @test
     */
    public function AddAfter_CanAddElementAfterSpecificNode() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $l1->addAfter($l1->first(), new LinkedListNode(2));
    
        # Assert:
        $afterNode = $l1->first()->next();
        $this->assertEquals(2, $afterNode->value());
    }

    /**
     * @test
     */
    public function AddAfter_ShouldChangeLastWhenNodeInsertAfterLast() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $l1->addAfter($l1->last(), new LinkedListNode(2));
    
        # Assert:
        $this->assertEquals(2, $l1->last()->value());
    }

    /**
     * @test
     * @expectedException \System\InvalidOperationException
     */
    public function AddBefore_ThrowsExceptionWhenNodeNotBelongsToLinkedList() 
    {
        # Arrange:
        $node = new LinkedListNode(1);
        $linkedList = new LinkedList;
    
        # Act:
        $linkedList->addBefore($node, new LinkedListNode(1));
    }

    /**
     * @test
     * @expectedException \System\InvalidOperationException
     */
    public function AddBefore_ThrowsExceptionWhenNewNodeBelongsToAnotherLinkedList() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l2 = new LinkedList;
        $l2->add(2);
        
        # Act:
        $l1->AddBefore($l1->first(), $l2->first());
    }

    /**
     * @test
     */
    public function AddBefore_CanAddElementAfterSpecificNode() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $l1->addBefore($l1->last(), new LinkedListNode(2));
    
        # Assert:
        $beforeNode = $l1->last()->previous();
        $this->assertEquals(2, $beforeNode->value());
    }

    /**
     * @test
     */
    public function AddBefore_ShouldChangeFirstWhenNodeInsertBeforeFirst() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $l1->addBefore($l1->first(), new LinkedListNode(2));
    
        # Assert:
        $this->assertEquals(2, $l1->first()->value());
    }

    /**
     * @test
     */
    public function AddFirst_ShouldAddElementWhenListIsEmpty() 
    {
        # Arrange:
        $l1 = new LinkedList;

        # Act:
        $l1->addFirst(1);
    
        # Assert:
        $this->assertEquals(1, $l1->first()->value());
    }

    /**
     * @test
     */
    public function AddFirst_ShouldAddElementWhenListContainsFirstElement() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);

        # Act:
        $l1->addFirst(2);
    
        # Assert:
        $this->assertEquals(2, $l1->first()->value());
    }

    /**
     * @test
     */
    public function AddFirst_ShouldAddElementsInSequence() 
    {
        # Arrange:
        $l1 = new LinkedList;
    
        # Act:
        for($i = 0; $i < 10; $i++)
        {
            $l1->addFirst($i);
        }
    
        # Assert:
        $this->assertEquals(9, $l1->first()->value());
    }

    /**
     * @test
     */
    public function AddFirst_ShouldCountWhenAddElementsInSequence() 
    {
        # Arrange:
        $l1 = new LinkedList;
    
        # Act:
        for($i = 0; $i < 10; $i++)
        {
            $l1->addFirst($i);
        }
    
        # Assert:
        $this->assertEquals(10, $l1->count());
    }

    /**
     * @test
     */
    public function AddLast_ShouldAddElementWhenListIsEmpty() 
    {
        # Arrange:
        $l1 = new LinkedList;

        # Act:
        $l1->addLast(1);
    
        # Assert:
        $this->assertEquals(1, $l1->last()->value());
    }

    /**
     * @test
     */
    public function AddLast_ShouldAddElementWhenListContainsLastElement() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);

        # Act:
        $l1->addLast(2);
    
        # Assert:
        $this->assertEquals(2, $l1->last()->value());
    }

    /**
     * @test
     */
    public function Clear_RemoveAllElements() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l1->addLast(2);
    
        # Act:
        $l1->clear();
    
        # Assert:
        $this->assertEquals(0, $l1->count());
    }

    /**
     * @test
     */
    public function Contains_ShouldBeTrueWhenValueIsFoundedInLinkedList() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $result = $l1->contains(1);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Contains_ShouldBeFalseWhenValueNotExistsInLinkedList() 
    {
        #  Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $result = $l1->contains(2);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function Contains_ShouldBeTrueWhenListContainsManyValues() 
    {
        #  Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l1->add(2);
        $l1->add(3);
        $l1->add(4);
        $l1->add(5);
        $l1->add(6);
        $l1->add(7);
    
        # Act:
        $result = $l1->contains(5);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Contains_ShouldBeFalseWhenListContainsManyValues() 
    {
        #  Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l1->add(2);
        $l1->add(3);
        $l1->add(4);
        $l1->add(5);
        $l1->add(6);
        $l1->add(7);
    
        # Act:
        $result = $l1->contains('a');
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function CopyTo_ThrowsExceptionWhenIndexIsGreaterThanValue() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $array = $l1->copyTo(2);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
    
        # Act:
        $array = $l1->copyTo(-1);
    }

    /**
     * @test
     */
    public function Equals_ShouldBeTrueWhenInstanceIsTheSame() 
    {
        # Arrange:
        $linkedList = new LinkedList;

        # Act:
        $result = $linkedList->equals($linkedList);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Equals_ShouldBeFalseWhenInstanceIsAnother() 
    {
        # Arrange:
        $linkedList = new LinkedList;

        # Act:
        $result = $linkedList->equals(1);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function Find_ShouldFindElementInLinkedList() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l1->add(2);
        $l1->add(3);

        # Act:
        $result = $l1->find(2);
    
        # Assert:
        $this->assertNotNull($result);
    }

    /**
     * @test
     */
    public function Find_ShouldReturnNullWhenNotFound() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l1->add(2);
        $l1->add(3);

        # Act:
        $result = $l1->find(4);
    
        # Assert:
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function Find_ShouldReturnNullWhenListIsEmpty() 
    {
        # Arrange:
        $l1 = new LinkedList;

        # Act:
        $result = $l1->find(4);
    
        # Assert:
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function FindLast_ShouldFindElementInLinkedList() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l1->add(2);
        $l1->add(3);
        $l1->add(2);

        # Act:
        $result = $l1->findLast(2);
    
        # Assert:
        $this->assertEquals(3, $result->previous()->value());
    }

    /**
     * @test
     */
    public function FindLast_ShouldReturnNullWhenNotFound() 
    {
        # Arrange:
        $l1 = new LinkedList;
        $l1->add(1);
        $l1->add(2);
        $l1->add(3);

        # Act:
        $result = $l1->findLast(4);
    
        # Assert:
        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function FindLast_ShouldReturnNullWhenListIsEmpty() 
    {
        # Arrange:
        $l1 = new LinkedList;

        # Act:
        $result = $l1->findLast(4);
    
        # Assert:
        $this->assertNull($result);
    }


}
