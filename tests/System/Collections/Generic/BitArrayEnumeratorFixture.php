<?php

require_once dirname(__FILE__) . '/../../../../system/collections/BitArray.php';

use \System\Collections\BitArray as BitArray;

class BitArrayEnumeratorFixture  extends PHPUnit_Framework_TestCase {

    private $enumerator;

    public function setUp() {
        $array = new BitArray(array(true, false, true, false));
        $this->enumerator = $array->getEnumerator();
    }

    public function test_Current_ThrowExceptionIfFirstElementNotPositioned() {
        $this->setExpectedException("\\System\\InvalidOperationException");
        $this->enumerator->current();
    }

    public function test_Current_CanGetCurrentElement() {
        $this->enumerator->moveNext();
        $this->assertEquals(true, $this->enumerator->current());
    }

    public function test_Current_CanMoveThroughTheEnumerator() {
        $actualPosition = 1;
        while($this->enumerator->moveNext()) {
            $element = ($actualPosition % 2 == 0) ? false : true;
            $this->assertEquals($element, $this->enumerator->current());
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
        $this->assertEquals(true, $this->enumerator->current());
    }

}
?>
