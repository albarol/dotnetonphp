<?php

use \System\Collections\Queue as Queue;


class QueueTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function Construct_ThrowExceptionWhenCapacityIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Queue(-1);
    }

    /**
     * @test
    */
    public function Construct_ThrowExceptionWhenGrowFactorIsLessThanOne() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Queue(1, 0.9);
    }

    /**
     * @test
    */
    public function Construct_ThrowExceptionWhenGroFactorIsGreaterThanTen() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new Queue(1, 10.1);
    }

    /**
     * @test
    */
    public function Construct_CanConstructQueueWithoutSize() {
        $queue = new Queue();
        $this->assertEquals(0, $queue->count());
    }

    /**
     * @test
    */
    public function Construct_CanConstructQueueWithLimitSize() {
        $queue = new Queue(2);
        $this->assertEquals(0, $queue->count());
    }

    /**
     * @test
    */
    public function Construct_CanConstructQueueWithGrowFactor() {
        $queue = new Queue(3, 1.5);
        $this->assertEquals(0, $queue->count());
    }

    /**
     * @test
    */
    public function Construct_CanConstructFromCollection() {
        $firstQueue = new Queue();
        $firstQueue->enqueue(1);
        $queue = new Queue($firstQueue);
        $this->assertEquals(1, $queue->count());
    }

    /**
     * @test
    */
    public function Clear_ShouldClearQueue() {
        $queue = new Queue();
        $queue->enqueue(10);
        $queue->enqueue(20);
        $queue->clear();
        $this->assertEquals(0, $queue->count());
    }

    /**
     * @test
    */
    public function Contains_ShouldBeTrueWhenElementWasFound() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue('dotnetonphp');
        $this->assertTrue($queue->contains(1));
    }

    /**
     * @test
    */
    public function Contains_ShouldBeFalseWhenElementWasNotFound() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue('dot');
        $this->assertFalse($queue->contains('netonphp'));
    }

    /**
     * @test
    */
    public function Contains_ShouldBeFalseWhenObjRemovedFromQueue() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue('dot');
        $queue->dequeue();
        $this->assertFalse($queue->contains(1));
    }

    /**
     * @test
    */
    public function CopyTo_ThrowsExceptionWhenArrayIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $queue = new Queue;
        $array = null;
        $queue->copyTo($array, 0);
    }

    /**
     * @test
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $queue = new Queue;
        $array = array();
        $queue->copyTo($array, -1);
    }

    /**
     * @test
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $queue = new Queue;
        $array = array();
        $queue->copyTo($array, 2);
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyQueueToArray() {
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue(2);
        $array = array();
        $queue->copyTo($array, 0);
        $this->assertEquals(2, sizeof($array));
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyPartOfQueueToArray() {
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);
        $array = array();
        $queue->copyTo($array, 1);
        $this->assertEquals(2, sizeof($array));
    }

    /**
     * @test
    */
    public function Dequeue_ThrowExceptionWhenQueueIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $queue = new Queue();
        $queue->dequeue();
    }

    /**
     * @test
    */
    public function Dequeue_ShouldDequeueElement() {
        $queue = new Queue();
        $queue->enqueue('dotnetonphp');
        $this->assertEquals('dotnetonphp', $queue->dequeue());
    }

    /**
     * @test
    */
    public function Dequeue_ShouldDequeueInSequence() {
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

    /**
     * @test
    */
    public function Enqueue_ShouldEnqueueElement() {
        $queue = new Queue();
        $queue->enqueue(1);
        $this->assertEquals(1, $queue->count());
    }

    /**
     * @test
    */
    public function Enqueue_ShouldEnqueueWhenValueIsNull() {
        $queue = new Queue();
        $queue->enqueue(null);
        $this->assertEquals(1, $queue->count());
    }

    /**
     * @test
    */
    public function Enqueue_ShouldEnqueueTwoElements() {
        $queue = new Queue(2);
        $queue->enqueue("dot");
        $queue->enqueue("net");
        $queue->enqueue("onphp");
        $this->assertEquals(2, $queue->count());
    }

    /**
     * @test
    */
    public function Enqueue_ShouldEnqueueOneElementAfterDequeue() {
        $queue = new Queue(2);
        $queue->enqueue("dot");
        $queue->enqueue("net");
        $queue->dequeue();
        $queue->enqueue("onphp");
        $this->assertEquals(2, $queue->count());
    }

    /**
     * @test
    */
    public function Enqueue_ShouldEnqueueTwoElementsWhenGrowFactorIsOnePointFive() {
        $queue = new Queue(3, 1.5);
        $queue->enqueue("dot");
        $queue->enqueue("net");
        $queue->dequeue();
        $queue->enqueue("on");
        $queue->enqueue("php");
        $this->assertEquals('net', $queue->dequeue());
        $this->assertEquals('on', $queue->dequeue());
    }

    /**
     * @test
    */
    public function GetEnumerator_CanGetEnumerator() {
        $queue = new Queue();
        $queue->enqueue(1);
        $queue->enqueue(2);
        $enumerator = $queue->getEnumerator();
        $this->assertTrue($enumerator instanceof \System\Collections\IEnumerator);
    }

    /**
     * @test
    */
    public function Peek_ThrowsExceptionWhenQueueIsEmpty() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $queue = new Queue();
        $queue->peek();
    }

    /**
     * @test
    */
    public function Peek_ShouldGetTopOfQueue() {
        $queue = new Queue();
        $queue->enqueue(10);
        $queue->enqueue(20);
        $this->assertEquals(10, $queue->peek());
        $this->assertEquals(10, $queue->peek());
    }

    /**
     * @test
    */
    public function ToArray_CanTransformQueueToArray() {
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue('dotnetonphp');
        $array = $queue->toArray();
        $this->assertTrue(is_array($array));
    }

    /**
     * @test
    */
    public function TrimToSize_CanModifyNumberOfSizeFromQueue() {
        $queue = new Queue(10);
        $queue->enqueue(1);
        $queue->trimToSize();
        $queue->enqueue(2);
        $queue->enqueue(3);
        $this->assertEquals(1, $queue->count());
    }

    /**
     * @test
    */
    public function TrimToSize_WhenGrowFactorExists() {
        $queue = new Queue(10, 1.5);
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->trimToSize();
        $queue->enqueue(3);
        $this->assertEquals(2, $queue->count());
    }
}
