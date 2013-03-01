<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\Collections\BitArray as BitArray;

/**
 * Test class for BitArray.
 */
class BitArrayFixture extends PHPUnit_Framework_TestCase {

    protected $BitArray;

    public function setUp(){
        $this->BitArray = new BitArray(
            array(true, false, true, false)
        );
    }

    public function test_Construct_ThrowsExceptionWhenValueIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        new BitArray(null);
    }

    public function test_Construct_ThrowsExceptionWhenArgumentIsInvalid() {
        $this->setExpectedException("\\System\\ArgumentException");
        new BitArray(array('a', 'b'));
    }

    public function test_Construct_CanConstructBitArray() {
        $array = new BitArray(array(true, false));
        $this->assertEquals(2, $array->count());
    }


    public function test_AndOperator_ThrowsExceptionWhenDontHaveSameNumberOfElements() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new BitArray(array(true, false));
        $this->BitArray->andOperator($array);
    }

    public function test_AndOperator_CanGetNewBitArrayAfterOperation() {
        $array = new BitArray(array(false, true, false, true));
        $b = $this->BitArray->andOperator($array);
        //All elements should be false
        $this->assertEquals(false, $b->get(0));
        $this->assertEquals(false, $b->get(1));
        $this->assertEquals(false, $b->get(2));
        $this->assertEquals(false, $b->get(3));
    }

    public function test_CopyTo_ThrowsExceptionWhenArrayIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $array = null;
        $this->BitArray->copyTo($array, 0);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $buffer = array();
        $this->BitArray->copyTo($buffer, -1);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $buffer = array();
        $this->BitArray->copyTo($buffer, 7);
    }

    public function test_CopyTo_CanCopyBitArrayToArray() {
        $buffer = array();
        $this->BitArray->copyTo($buffer, 0);
        $this->assertEquals(4, sizeof($buffer));
    }

    public function test_CopyTo_CanCopyPartOfBitArrayToArray() {
        $buffer = array();
        $this->BitArray->copyTo($buffer, 1);
        $this->assertEquals(3, sizeof($buffer));
    }

    public function test_Get_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $this->BitArray->get(-1);
    }

    public function test_Get_ThrowsExceptionWhenIndexIsGreaterThanSizeOfBitArray() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $this->BitArray->get(10);
    }

    public function test_Get_CanGetElementFromBitArray() {
        $this->assertEquals(true, $this->BitArray->get(0));
    }

    public function test_GetEnumerator_CanGetEnumerator() {
        $this->isTrue($this->BitArray->getEnumerator() instanceof IEnumerator);
    }

    public function test_Length_ThrowsExceptionWhenValueIsThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $this->BitArray->length(-1);
    }

    public function test_Length_CanDetermineLengthOfArray() {
        $this->BitArray->length(3);
        $this->assertEquals(3, $this->BitArray->count());
    }

    public function test_Length_GrowLengthOfArray() {
        $this->BitArray->length(10);
        $this->assertEquals(4, $this->BitArray->count());
    }

    public function test_NotOperator_GetInverseBitArray(){
        $b = $this->BitArray->notOperator();
        $this->assertFalse($b->get(0));
        $this->assertTrue($b->get(1));
        $this->assertFalse($b->get(2));
        $this->assertTrue($b->get(3));
    }

    public function test_OrOperator_ThrowsExceptionWhenDontHaveSameNumberOfElements() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new BitArray(array(true, false));
        $this->BitArray->orOperator($array);
    }

    public function test_OrOperator_CanGetNewBitArrayAfterOperation() {
        $array = new BitArray(array(false, false, false, true));
        $b = $this->BitArray->orOperator($array);
        $this->assertTrue($b->get(0));
        $this->assertFalse($b->get(1));
        $this->assertTrue($b->get(2));
        $this->assertTrue($b->get(3));
    }

    public function test_Set_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $this->BitArray->get(-1, true);
    }

    public function test_Set_ThrowsExceptionWhenIndexIsGreaterThanSizeOfBitArray() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $this->BitArray->set(10, true);
    }

    public function test_Set_CanGetElementFromBitArray() {
        $this->BitArray->set(1, true);
        $this->assertTrue($this->BitArray->get(1));
    }

    public function test_SetAll_CanSetAllElementsInArray(){
        $this->BitArray->setAll(true);
        for($i = 0; $i < $this->BitArray->count(); $i++)
            $this->assertTrue($this->BitArray->get($i));
    }

    public function test_XorOperator_ThrowsExceptionWhenDontHaveSameNumberOfElements() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new BitArray(array(true, false));
        $this->BitArray->orOperator($array);
    }

    public function test_XorOperator_CanGetNewBitArrayAfterOperation() {
        $array = new BitArray(array(true, true, false, false));
        $b = $this->BitArray->xorOperator($array);
        $this->assertTrue($b->get(0));
        $this->assertFalse($b->get(1));
        $this->assertTrue($b->get(2));
        $this->assertFalse($b->get(3));
    }
}
