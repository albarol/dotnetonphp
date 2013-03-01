<?php

require_once dirname(__FILE__) . '/../../../../src/Autoloader.php';

use \System\Collections\Queue as Queue;

class QueueEnumeratorFixture  extends PHPUnit_Framework_TestCase {

    private $enumerator;

    public function setUp() {
        $queue = new Queue;
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);
        $queue->enqueue(4);
        $this->enumerator = $queue->getEnumerator();
    }

    public function test_Current_ThrowExceptionIfFirstElementNotPositioned() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $this->enumerator->current();
    }

    public function test_Current_CanGetCurrentElement() {
        $this->enumerator->moveNext();
        $this->assertEquals(1, $this->enumerator->current());
    }

    public function test_Current_CanMoveThroughTheEnumerator() {
        $actualPosition = 1;
        while($this->enumerator->moveNext()) {
            $this->assertEquals($actualPosition, $this->enumerator->current());
            $actualPosition++;
        }
    }

    public function test_MoveNext_CanMoveNext() {
        $this->assertTrue($this->enumerator->moveNext());
    }

    public function test_MoveNext_CantMoveIfAllElementsCovered() {
        $this->enumerator->moveNext();
        $this->enumerator->moveNext();
        $this->enumerator->moveNext();
        $this->enumerator->moveNext();
        $this->assertFalse($this->enumerator->moveNext());
    }



    public function test_Reset_CanResetEnumerator() {
        $this->enumerator->moveNext();
        $this->enumerator->moveNext();
        $this->enumerator->moveNext();
        $this->enumerator->reset();
        $this->assertEquals(1, $this->enumerator->current());
    }

}
