<?php

use \System\Collections\Stack as Stack;

/**
 * group collections
*/
class StackTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function Construct_ThrowsExceptionWhenInitialCapacityIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Stack(-1);
    }

    /**
     * @test
    */
    public function Construct_CanConstructWithDefaultCapacity() {
        $stack = new Stack; //default capacity is ten
        for($i = 0; $i < 10; $i++)
            $stack->push($i);
        $this->assertEquals(10, $stack->count());
    }

    /**
     * @test
    */
    public function Construct_CanConstructWithCustomCapacity() {
        $stack = new Stack(2);
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $this->assertEquals(2, $stack->count());
    }

    /**
     * @test
    */
    public function Construct_CanConstructFromCollection() {
        $firstStack = new Stack();
        $firstStack->push(1);
        $stack = new Stack($firstStack);
        $this->assertEquals(1, $stack->count());
    }

    /**
     * @test
    */
    public function Clear_CanClearElementsOfStack() {
        $stack = new Stack;
        $stack->push(1);
        $stack->clear();
        $this->assertEquals(0, $stack->count());
    }

    /**
     * @test
    */
    public function Contains_ShouldBeTrueWhenElementIsFound() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertTrue($stack->contains(1));
    }

    /**
     * @test
    */
    public function Contains_ShouldBeFalseWhenElementsNotFound() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertFalse($stack->contains('dotnetonphp'));
    }

    /**
     * @test
    */
    public function CopyTo_ThrowsExceptionWhenArrayIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $stack = new Stack;
        $array = null;
        $stack->copyTo($array, 0);
    }

    /**
     * @test
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $stack = new Stack;
        $array = array();
        $stack->copyTo($array, -1);
    }

    /**
     * @test
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $stack = new Stack;
        $array = array();
        $stack->copyTo($array, 2);
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyStackToArray() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $array = array();
        $stack->copyTo($array, 0);
        $this->assertEquals(2, sizeof($array));
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyPartOfStackToArray() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $array = array();
        $stack->copyTo($array, 1);
        $this->assertEquals(2, sizeof($array));
    }

    /**
     * @test
    */
    public function GetEnumerator_CanGetEnumerator() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertTrue($stack->getEnumerator() instanceof \System\Collections\IEnumerator);
    }

    /**
     * @test
    */
    public function Peek_ThrowExceptionWhenStackIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $stack = new Stack;
        $stack->peek();
    }

    /**
     * @test
    */
    public function Peek_CanPeekCurrentElement() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $this->assertEquals(2, $stack->peek());
    }

    /**
     * @test
    */
    public function Pop_ThrowsExceptionWhenStackIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $stack = new Stack;
        $stack->pop();
    }

    /**
     * @test
    */
    public function Pop_CanPopLastElement() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $stack->pop();
        $this->assertEquals(1, $stack->peek());
    }

    /**
     * @test
    */
    public function Push_CanPushNullValue() {
        $stack = new Stack;
        $stack->push(null);
        $this->assertEquals(1, $stack->count());
    }

    /**
     * @test
    */
    public function Push_CanPushAnyElement() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertEquals(1, $stack->count());
    }

    /**
     * @test
    */
    public function Push_PushOnlyToCapacity() {
        $stack = new Stack(2);
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $this->assertEquals(2, $stack->count());
    }

    /**
     * @test
    */
    public function ToArray_CanTransformStackInArray() {
        $stack = new Stack(2);
        $stack->push(1);
        $stack->push(2);
        $array = $stack->toArray();
        $this->assertTrue(is_array($array));
    }
}
