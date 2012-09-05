<?php

require_once dirname(__FILE__) . '/../../../../system/collections/Stack.php';

use \System\Collections\Stack as Stack;


class StackEnumeratorFixture  extends PHPUnit_Framework_TestCase {

    private $enumerator;

    public function setUp() {
        $stack = new Stack;
        $stack->push(1);
        $stack->push(2);
        $stack->push(3);
        $stack->push(4);
        $this->enumerator = $stack->getEnumerator();
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
?>
