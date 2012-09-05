<?php

require_once dirname(__FILE__) . '/../../../system/collections/Stack.php';

use \System\Collections\Stack as Stack;


class StackFixture extends PHPUnit_Framework_TestCase {

    public function test_Construct_ThrowsExceptionWhenInitialCapacityIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Stack(-1);
    }

    public function test_Construct_CanConstructWithDefaultCapacity() {
        $stack = new Stack; //default capacity is ten
        for($i = 0; $i < 10; $i++)
            $stack->push($i);
        $this->assertEquals(10, $stack->count());
    }

    public function test_Construct_CanConstructWithCustomCapacity() {
        $stack = new Stack(2);
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $this->assertEquals(2, $stack->count());
    }

    public function test_Construct_CanConstructFromCollection() {
        $firstStack = new Stack();
        $firstStack->push(1);
        $stack = new Stack($firstStack);
        $this->assertEquals(1, $stack->count());
    }

    public function test_Clear_CanClearElementsOfStack() {
        $stack = new Stack;
        $stack->push(1);
        $stack->clear();
        $this->assertEquals(0, $stack->count());
    }

    public function test_Contains_ShouldBeTrueWhenElementIsFound() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertTrue($stack->contains(1));
    }

    public function test_Contains_ShouldBeFalseWhenElementsNotFound() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertFalse($stack->contains('dotnetonphp'));
    }

    public function test_CopyTo_ThrowsExceptionWhenArrayIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $stack = new Stack;
        $array = null;
        $stack->copyTo($array, 0);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $stack = new Stack;
        $array = array();
        $stack->copyTo($array, -1);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $stack = new Stack;
        $array = array();
        $stack->copyTo($array, 2);
    }

    public function test_CopyTo_CanCopyStackToArray() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $array = array();
        $stack->copyTo($array, 0);
        $this->assertEquals(2, sizeof($array));
    }

    public function test_CopyTo_CanCopyPartOfStackToArray() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $array = array();
        $stack->copyTo($array, 1);
        $this->assertEquals(2, sizeof($array));
    }

    public function test_GetEnumerator_CanGetEnumerator() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertTrue($stack->getEnumerator() instanceof \System\Collections\IEnumerator);
    }

    public function test_Peek_ThrowExceptionWhenStackIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $stack = new Stack;
        $stack->peek();
    }

    public function test_Peek_CanPeekCurrentElement() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $this->assertEquals(2, $stack->peek());
    }

    public function test_Pop_ThrowsExceptionWhenStackIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $stack = new Stack;
        $stack->pop();
    }

    public function test_Pop_CanPopLastElement() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $stack->pop();
        $this->assertEquals(1, $stack->peek());
    }

    public function test_Push_CanPushNullValue() {
        $stack = new Stack;
        $stack->push(null);
        $this->assertEquals(1, $stack->count());
    }

    public function test_Push_CanPushAnyElement() {
        $stack = new Stack;
        $stack->push(1);
        $this->assertEquals(1, $stack->count());
    }

    public function test_Push_PushOnlyToCapacity() {
        $stack = new Stack(2);
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $this->assertEquals(2, $stack->count());
    }

    public function test_ToArray_CanTransformStackInArray() {
        $stack = new Stack(2);
        $stack->push(1);
        $stack->push(2);
        $array = $stack->toArray();
        $this->assertTrue(is_array($array));
    }
}
?>
