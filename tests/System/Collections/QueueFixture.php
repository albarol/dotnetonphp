<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');

use \System\Collections\Queue as Queue;


class QueueFixture extends PHPUnit_Framework_TestCase {

    public function test_Construct_ThrowExceptionWhenCapacityIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Queue(-1);
    }

    public function test_Construct_ThrowExceptionWhenGrowFactorIsLessThanOne() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Queue(1, 0.9);
    }

    public function test_Construct_ThrowExceptionWhenGroFactorIsGreaterThanTen() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Queue(1, 10.1);
    }

    public function test_Construct_CanConstructQueueWithoutSize() {
        $queue = new Queue();
        $this->assertEquals(0, $queue->count());
    }

    public function test_Construct_CanConstructQueueWithLimitSize() {
        $queue = new Queue(2);
        $this->assertEquals(0, $queue->count());
    }

    public function test_Construct_CanConstructQueueWithGrowFactor() {
        $queue = new Queue(3, 1.5);
        $this->assertEquals(0, $queue->count());
    }

    public function test_Construct_CanConstructFromCollection() {
        $firstQueue = new Queue();
        $firstQueue->enqueue(1);
        $queue = new Queue($firstQueue);
        $this->assertEquals(1, $queue->count());
    }

    public function test_Clear_ShouldClearQueue() {
        $queue = new Queue();
        $queue->enqueue(10);
        $queue->enqueue(20);
        $queue->clear();
        $this->assertEquals(0, $queue->count());
    }

    public function test_Contains_ShouldBeTrueWhenElementWasFound() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue('dotnetonphp');
        $this->assertTrue($queue->contains(1));
    }

    public function test_Contains_ShouldBeFalseWhenElementWasNotFound() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue('dot');
        $this->assertFalse($queue->contains('netonphp'));
    }

    public function test_Contains_ShouldBeFalseWhenObjRemovedFromQueue() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue('dot');
        $queue->dequeue();
        $this->assertFalse($queue->contains(1));
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $queue = new Queue;
        $array = array();
        $queue->copyTo($array, -1);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $queue = new Queue;
        $array = array();
        $queue->copyTo($array, 2);
    }

    public function test_CopyTo_CanCopyQueueToArray() {
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue(2);
        $array = array();
        $queue->copyTo($array, 0);
        $this->assertEquals(2, sizeof($array));
    }

    public function test_CopyTo_CanCopyPartOfQueueToArray() {
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);
        $array = array();
        $queue->copyTo($array, 1);
        $this->assertEquals(2, sizeof($array));
    }

    public function test_Count_CanCountNumberOfElements() {
        # Arrange:
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue(2);

        # Act:
        $count = $queue->count();

        # Assert:
        $this->assertEquals(2, $count);
    }

    public function test_Dequeue_ThrowExceptionWhenQueueIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $queue = new Queue();
        $queue->dequeue();
    }

    public function test_Dequeue_ShouldDequeueElement() {
        $queue = new Queue();
        $queue->enqueue('dotnetonphp');
        $this->assertEquals('dotnetonphp', $queue->dequeue());
    }

    public function test_Dequeue_ShouldDequeueInSequence() {
        $queue = new Queue();
        $queue->enqueue('dot');
        $queue->enqueue('net');
        $queue->enqueue('on');
        $queue->enqueue('php');
        $this->assertEquals('dot', $queue->dequeue());
        $this->assertEquals('net', $queue->dequeue());
        $this->assertEquals('on', $queue->dequeue());
        $this->assertEquals('php', $queue->dequeue());
    }

    public function test_Enqueue_ShouldEnqueueElement() {
        $queue = new Queue();
        $queue->enqueue(1);
        $this->assertEquals(1, $queue->count());
    }

    public function test_Enqueue_ShouldEnqueueWhenValueIsNull() {
        $queue = new Queue();
        $queue->enqueue(null);
        $this->assertEquals(1, $queue->count());
    }

    public function test_Enqueue_ShouldEnqueueTwoElements() {
        $queue = new Queue(2);
        $queue->enqueue("dot");
        $queue->enqueue("net");
        $queue->enqueue("onphp");
        $this->assertEquals(2, $queue->count());
    }

    public function test_Enqueue_ShouldEnqueueOneElementAfterDequeue() {
        $queue = new Queue(2);
        $queue->enqueue("dot");
        $queue->enqueue("net");
        $queue->dequeue();
        $queue->enqueue("onphp");
        $this->assertEquals(2, $queue->count());
    }

    public function test_Enqueue_ShouldEnqueueTwoElementsWhenGrowFactorIsOnePointFive() {
        $queue = new Queue(3, 1.5);
        $queue->enqueue("dot");
        $queue->enqueue("net");
        $queue->dequeue();
        $queue->enqueue("on");
        $queue->enqueue("php");
        $this->assertEquals('net', $queue->dequeue());
        $this->assertEquals('on', $queue->dequeue());
    }

    public function test_GetEnumerator_CanGetEnumerator() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue(2);
        $enumerator = $queue->getEnumerator();
        $this->assertTrue($enumerator instanceof \System\Collections\IEnumerator);
    }

    public function test_Peek_ThrowsExceptionWhenQueueIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $queue = new Queue();
        $queue->peek();
    }

    public function test_Peek_ShouldGetTopOfQueue() {
        $queue = new Queue();
        $queue->enqueue(10);
        $queue->enqueue(20);
        $this->assertEquals(10, $queue->peek());
        $this->assertEquals(10, $queue->peek());
    }

    public function test_ToArray_CanTransformQueueToArray() {
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue('dotnetonphp');
        $array = $queue->toArray();
        $this->assertTrue(is_array($array));
    }

    public function test_TrimToSize_CanModifyNumberOfSizeFromQueue() {
        $queue = new Queue(10);
        $queue->enqueue(1);
        $queue->trimToSize();
        $queue->enqueue(2);
        $queue->enqueue(3);
        $this->assertEquals(1, $queue->count());
    }

    public function test_TrimToSize_WhenGrowFactorExists() {
        $queue = new Queue(10, 1.5);
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->trimToSize();
        $queue->enqueue(3);
        $this->assertEquals(2, $queue->count());
    }
}
?>
