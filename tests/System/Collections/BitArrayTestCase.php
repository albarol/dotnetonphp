<?php

use \System\Collections\BitArray as BitArray;

class BitArrayTestCase extends PHPUnit_Framework_TestCase {

    protected $bit_array;

    public function setUp() {
        $this->bit_array = new BitArray(
            array(true, false, true, false)
        );
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Construct_ThrowsExceptionWhenValueIsNull() {
        
        # Arrange:
        # Act:
        new BitArray(null);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Construct_ThrowsExceptionWhenArgumentIsInvalid() {
        
        # Arrange:
        # Act:
        new BitArray(array('a', 'b'));
    }

    /**
     * @test
    */
    public function Construct_CanConstructBitArray() {
        
        # Arrange:
        $bits = array(true, false);
        
        # Act:
        $array = new BitArray($bits);
        
        # Assert:
        $this->assertEquals(2, $array->count());
    }


    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function AndOperator_ThrowsExceptionWhenDontHaveSameNumberOfElements() {
        
        # Arrange:
        $bits = array(true, false);
        $array = new BitArray($bits);

        # Act:
        $this->bit_array->andOperator($array);
    }

    /**
     * @test
    */
    public function AndOperator_ShouldBeFalseAllElements() 
    {
        # Arrange:
        $bits = array(false, true, false, true);
        $array = new BitArray($bits);

        # Act:
        $b = $this->bit_array->andOperator($array);

        for($i = 0; $i < $b->count(); $i++)
        {
            $this->assertEquals(false, $b->get(0));    
        }
    }

    /**
     * @test
    */
    public function AndOperator_ShouldBeTrueAllElements() {
        
        # Arrange:
        $bits = array(true, false, true, false);
        $array = new BitArray($bits);

        # Act:
        $b = $this->bit_array->andOperator($array);

        for($i = 0; $i < $b->count(); $i++)
        {
            $this->assertEquals(true, $b->get(0));
        }
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        $buffer = array();
        
        # Act:
        $this->bit_array->copyTo(-1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        # Act:
        $this->bit_array->copyTo(7);
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyBitArrayToArray() {
        # Act:
        $buffer = $this->bit_array->copyTo(0);
        
        # Assert:
        $this->assertEquals(4, sizeof($buffer));
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyPartOfBitArrayToArray() {

        # Act:
        $buffer = $this->bit_array->copyTo(1);
        
        # Assert:
        $this->assertEquals(3, sizeof($buffer));
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Get_ThrowsExceptionWhenIndexIsLessThanZero() {

        # Arrange:
        # Act:
        $this->bit_array->get(-1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Get_ThrowsExceptionWhenIndexIsGreaterThanSizeOfBitArray() {
        
        # Arrange:
        # Act:
        $this->bit_array->get(10);
    }

    /**
     * @test
    */
    public function Get_CanGetElementFromBitArray() {
        
        # Arrange:
        $index = 0;

        # Act:
        $bit = $this->bit_array->get($index);

        # Assert:
        $this->assertEquals(true, $bit);
    }

    /**
     * @test
    */
    public function GetEnumerator_CanGetEnumerator() {
        
        # Arrange:
        # Act:
        $instanceof = 'System\\Collections\\IEnumerator';
        $enumerator = $this->bit_array->getEnumerator();

        # Assert:
        $this->assertInstanceOf($instanceof, $enumerator);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Length_ThrowsExceptionWhenValueIsThanZero() {
        
        # Arrange:
        # Act:
        $this->bit_array->length(-1);
    }

    /**
     * @test
    */
    public function Length_CanDetermineLengthOfArray() {
        
        # Arrange:
        $size = 3;

        # Act:
        $this->bit_array->length($size);

        # Assert:
        $this->assertEquals($size, $this->bit_array->count());
    }

    /**
     * @test
    */
    public function Length_GrowLengthOfArray() {
        
        # Arrange:
        $new_size = 10;
        $old_size = $this->bit_array->count();

        # Act:
        $this->bit_array->length($new_size);

        # Assert:
        $this->assertEquals($old_size, $this->bit_array->count());
    }

    /**
     * @test
    */
    public function NotOperator_GetInverseBitArray(){
        
        # Arrange:
        # Act:
        $negative_array = $this->bit_array->notOperator();

        # Assert:
        $this->assertFalse($negative_array->get(0));
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function OrOperator_ThrowsExceptionWhenDontHaveSameNumberOfElements() {
        
        # Arrange:
        $bits = array(true, false);
        $array = new BitArray($bits);
        
        # Act:
        $this->bit_array->orOperator($array);
    }

    /**
     * @test
    */
    public function OrOperator_CanGetNewBitArrayAfterOperation() {
        
        # Arrange:
        $bits = new BitArray(array(false, false, false, true));

        # Act:
        $new_bits = $this->bit_array->orOperator($bits);
        
        # Assert:
        $this->assertTrue($new_bits->get(0));
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Set_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        # Act:
        $this->bit_array->get(-1, true);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Set_ThrowsExceptionWhenIndexIsGreaterThanSizeOfBitArray() {
        
        # Arrange:
        # Act:
        $this->bit_array->set(10, true);
    }

    /**
     * @test
    */
    public function Set_CanSetElementFromBitArray() {
        
        # Arrange:
        # Act:
        $this->bit_array->set(1, true);
        
        # Assert:
        $this->assertTrue($this->bit_array->get(1));
    }

    /**
     * @test
    */
    public function SetAll_CanSetAllElementsInArray()
    {
        # Arrange:
        # Act:
        $this->bit_array->setAll(true);
        
        # Assert:
        for($i = 0; $i < $this->bit_array->count(); $i++)
        {
            $this->assertTrue($this->bit_array->get($i));
        }
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function XorOperator_ThrowsExceptionWhenDontHaveSameNumberOfElements() {
        
        # Arrange:
        $array = new BitArray(array(true, false));
        
        # Act:
        $this->bit_array->orOperator($array);
    }

    /**
     * @test
    */
    public function XorOperator_CanGetNewBitArrayAfterOperation() {
        
        # Arrange:
        $array = new BitArray(array(true, true, false, false));
        
        # Act:
        $b = $this->bit_array->xorOperator($array);
        
        # Assert:
        $this->assertFalse($b->get(1));
    }
}
