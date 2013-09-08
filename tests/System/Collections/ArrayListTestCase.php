<?php

use \System\Collections\ArrayList as ArrayList;

/**
 * @group collections
*/
class ArrayListTestCase extends PHPUnit_Framework_TestCase {

    private $list;

    public function setUp() {
        $this->list = new ArrayList;
        $this->list->add('dot');
        $this->list->add('net');
        $this->list->add('on');
        $this->list->add('php');
    }


    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenCapacityIsLessThanZero() {

        # Arrange:
        # Act:
        $list = new ArrayList(-1);
    }

    /**
     * @test
    */
    public function Construct_CanConstructWithCapacity() {
        
        # Arrange:
        $array = new ArrayList(1);
        
        # Act:
        $array->add(10);
        
        # Assert:
        $this->assertEquals(1, $array->count());
    }

    /**
     * @test
    */
    public function Constructor_CanCreateFromCollection() {
        
        # Arrange:
        $col = new ArrayList();
        $col->add(1);

        # Act:
        $array = new ArrayList($col);
        
        # Assert:
        $this->assertEquals($col->count(), $array->count());
    }

    /**
     * @test
    */
    public function Construct_CanCreateWithoutParameter() {
        
        # Arrange:
        $array = new ArrayList();
        
        # Act:
        $size = $array->count();

        # Assert:
        $this->assertEquals(0, $size);
    }

    /**
     * @test
    */
    public function Adapter_CanCreateFromList() {
        
        # Arrange:
        $list = new ArrayList();
        $list->add(1);

        # Act:
        $array = ArrayList::adapter($list);

        # Assert:
        $this->assertEquals(1, $array->count());
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Add_ThrowsExceptionWhenListIsReadOnly() {
        
        # Arrange:
        $array = new ArrayList;
        $read_only = ArrayList::readOnly($array);

        # Act:
        $read_only->add(1);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Add_ThrowsExceptionWhenIsFixedSize() {
        
        # Arrange:
        $fixed_array = ArrayList::fixedSize(new ArrayList);
  
        # Act:
        $fixed_array->add(1);
    }

    /**
     * @test
    */
    public function Add_CanAddElements() {
        
        # Arrange:
        $list = new ArrayList();

        # Act:
        $list->add("Php");

        # Assert:
        $this->assertEquals(1, $list->count());
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function AddRange_ThrowsExceptionWhenIsReadOnly(){

        # Arrange:
        $array = new ArrayList(10);
        $read_only = ArrayList::readOnly($array);

        # Act:
        $read_only->addRange(new ArrayList);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function AddRange_ThrowsExceptionWhenIsFixedSize(){
        
        # Arrange:
        $fixed_array = ArrayList::fixedSize(new ArrayList);

        # Act:
        $fixed_array->addRange(new ArrayList);
    }

    /**
     * @test
    */
    public function AddRange_CanAddRangeOfElements() {
        
        # Arrange:
        $range = new ArrayList();
        $range->add(1);
        
        $array = new ArrayList();

        # Act:
        $array->addRange($range);

        # Assert:
        $this->assertEquals(1, $array->count());
    }


    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Clear_ThrowsExceptionWhenIsReadOnly() {
        
        # Arrange:
        $read_only = ArrayList::readOnly(new ArrayList);

        # Act:
        $read_only->clear();
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Clear_ThrowsExceptionWhenIsFixedSize() {
        
        # Arrange:
        $read_only = ArrayList::fixedSize(new ArrayList);

        # Act:
        $read_only->clear();
    }

    /**
     * @test
    */
    public function Clear_CanClearElements() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        
        # Act:
        $array->clear();
        
        # Assert:
        $this->assertEquals(0, $array->count());
    }

    /**
     * @test
    */
    public function Contains_ShouldBeFalseWhenElementNotFound() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        
        # Act:
        $result = $array->contains('dotnetonphp');
        
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
    */
    public function Contains_ShouldBeTrueWhenElementFound() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        
        # Act:
        $result = $array->contains(1);
        
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        $array = new ArrayList;
        $buffer = array();
        
        # Act:
        $array->copyTo($buffer, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        
        # Arrange:
        $array = new ArrayList;
        $buffer = array();
        
        # Act:
        $array->copyTo($buffer, 2);
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyArrayListToArray() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        
        # Act:
        $buffer = $array->copyTo(0);
        
        # Assert:
        $this->assertEquals(2, sizeof($buffer));
    }

    /**
     * @test
    */
    public function CopyTo_CanCopyPartOfArrayListToArray() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        
        # Act:
        $buffer = $array->copyTo(1);
        
        # Assert:
        $this->assertEquals(1, sizeof($buffer));
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Get_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        $array = new ArrayList;
        
        # Act:
        $array->get(-1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Get_ThrowsExceptionWhenIndexIsGreaterThanCount() {
        
        # Arrange:
        $array = new ArrayList;
        
        # Act:
        $array->get(10);
    }

    /**
     * @test
    */
    public function Get_CanGetFirstElement() {
        
        # Arrange
        $array = new ArrayList;
        $array->add('dot');

        # Act:
        $el = $array->get(0);

        # Arrange:
        $this->assertEquals('dot', $el);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function GetRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        $array = new ArrayList;
        
        # Act:
        $result = $array->getRange(-1, 1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function GetRange_ThrowsExceptionWhenCountIsLessThanZero() {

        # Arrange:
        $array = new ArrayList;
        
        # Act:
        $result = $array->getRange(0, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function GetRange_ThrowsExceptionWhenCountAndIndexOutOfRange() {
        
        # Arrange:
        $array = new ArrayList;
        
        # Act:
        $array->getRange(0, 11);
    }

    /**
     * @test
    */
    public function GetRange_CanGetRangeFromArrayList() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $array->add(3);
        
        # Act:
        $rangeList = $array->getRange(0, 2);
        
        # Assert:
        $this->assertEquals(2, $rangeList->count());
    }

    /**
     * @test
    */
    public function IndexOf_ResultMinusOneWhenNotFound() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add('dot');

        # Act:
        $result = $array->indexOf(20);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function IndexOf_ResultShouldBeElementPositionWhenFound() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add('dot');
        
        # Act:
        $result = $array->indexOf('dot');
        
        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
    */
    public function IndexOf_ResultMinusOnWhenNotFoundAfterIndex() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf('dot', 3);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function IndexOf_ResultShouldBeElementPositionWhenFoundAfterIndex() {
        
        # Arrange:
        $array = new ArrayList;
        $array->add('dot');
        $array->add('net');
        $array->add('on');

        # Act:
        $result = $array->indexOf('on', 1);

        # Assert:
        $this->assertEquals(2, $result);
    }

    /**
     * @test
    */
    public function IndexOf_ResultMinusOnWhenNotFoundInRage() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf('dot', 2, 1);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function IndexOf_ResultShouldBeElementPositionWhenFoundInRange() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf('net', 0, 2);

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Insert_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insert(-1, 1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Insert_ThrowsExceptionWhenIndexGreaterThanCount() {
        
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insert(10, 1);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Insert_ThrowsExceptionWhenIsReadOnly() {
        
        # Arrange:
        $read_only = ArrayList::readOnly(new ArrayList);

        # Act:
        $read_only->insert(0, 1);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Insert_ThrowsExceptionWhenIsFixedSize() {
        
        # Arrange:
        $read_only = ArrayList::fixedSize(new ArrayList);

        # Act:
        $read_only->insert(0, 1);
    }

    /**
     * @test
    */
    public function Insert_CanInsertInStartList() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insert(0, 10);

        # Assert:
        $this->assertEquals(10, $array->get(0));
    }

    /**
     * @test
    */
    public function Insert_CanInsertWhenArrayListIsEmpty() {
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insert(0, 10);

        # Assert:
        $this->assertEquals(10, $array->get(0));
    }

    /**
     * @test
    */
    public function Insert_CanInsertElementInAnyPosition() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insert(2, 10);

        # Assert:
        $this->assertEquals(10, $array->get(2));
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function InsertRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insertRange(-1, $this->list);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function InsertRange_ThrowsExceptionWhenIndexGreaterThanCount() {
        
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insertRange(10, $this->list);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function InsertRange_ThrowsExceptionWhenIsReadOnly() {

        # Arrange:
        $read_only = ArrayList::readOnly(new ArrayList);

        # Act:
        $read_only->insertRange(0, $this->list);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function InsertRange_ThrowsExceptionWhenIsFixedSize() {
        
        # Arrange:
        $read_only = ArrayList::fixedSize(new ArrayList);

        # Act:
        $read_only->insertRange(0, $this->list);
    }

    /**
     * @test
    */
    public function InsertRange_CanInsertInStartList() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insertRange(0, $this->list);

        # Assert:
        $this->assertEquals('dot', $array->get(0));
    }

    /**
     * @test
    */
    public function InsertRange_CanInsertWhenArrayListIsEmpty() {
        
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insertRange(0, $this->list);

        # Assert:
        $this->assertEquals('net', $array->get(1));
    }

    /**
     * @test
    */
    public function InsertRange_CanInsertElementInAnyPosition() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insertRange(2, $this->list);

        # Assert:
        $this->assertEquals('dot', $array->get(2));
    }

    /**
     * @test
    */
    public function LastIndexOf_ResultMinusOneWhenNotFound() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf(20);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function LastIndexOf_ResultShouldBeElementPositionWhenFound() {
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $array->add(3);
        $array->add(1);

        # Act:
        $result = $array->lastIndexOf(1);

        # Assert:
        $this->assertEquals(3, $result);
    }

    /**
     * @test
    */
    public function LastIndexOf_ResultMinusOnWhenNotFoundAfterIndex() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf(3, 3);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function LastIndexOf_ResultShouldBeElementPositionWhenFoundAfterIndex() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf('on', 1);

        # Assert:
        $this->assertEquals(2, $result);
    }

    /**
     * @test
    */
    public function LastIndexOf_ResultMinusOnWhenNotFoundInRage() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf(2, 0, 2);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function LastIndexOf_ResultShouldBeElementPositionWhenFoundInRange() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf('net', 0, 2);

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Remove_ThrowsExceptionWhenArrayIsReadOnly() {
        
        # Arrange:
        $read_only = ArrayList::readOnly(new ArrayList);

        # Act:
        $read_only->remove(1);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Remove_ThrowsExceptionWhenArrayIsFixedSize() {

        # Arrange:
        $fixed_size = ArrayList::fixedSize(new ArrayList);

        # Act:
        $fixed_size->remove(1);
    }

    /**
     * @test
    */
    public function Remove_CanRemoveElement() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->remove('dot');

        # Assert:
        $this->assertEquals(3, $array->count());
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function RemoveAt_ThrowsExceptionWhenArrayIsReadOnly() {
        # Arrange:
        $read_only = ArrayList::readOnly(new ArrayList);

        # Act:
        $read_only->removeAt(1);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function RemoveAt_ThrowsExceptionWhenArrayIsFixedSize() {
        
        # Arrange:
        $fixed_size = ArrayList::fixedSize(new ArrayList);

        # Act:
        $fixed_size->removeAt(1);
    }

    /**
     * @test
    */
    public function RemoveAt_CanRemoveElement() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeAt(0);

        # Assert:
        $this->assertEquals(3, $array->count());
    }

    /**
     * @test
    */
    public function RemoveAt_CanReorganizeArrayList() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeAt(0);

        # Assert:
        $this->assertEquals('net', $array->get(0));
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function RemoveRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeRange(-1, 1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function RemoveRange_ThrowsExceptionWhenCountIsLessThanZero() {

        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeRange(0, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function RemoveRange_ThrowsExceptionWhenRangeIsInvalid() {
        
        # Arrange:
        $array = new ArrayList($this->list);
        
        # Act:
        $array->removeRange(0, 15);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function RemoveRange_ThrowsExceptionWhenArrayListIsReadOnly() {

        # Arrange:
        $array = ArrayList::readOnly(new ArrayList);

        # Act:
        $array->removeRange(0, 15);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function RemoveRange_ThrowsExceptionWhenArrayListIsFixedSize() {

        # Arrange:
        $array = ArrayList::fixedSize(new ArrayList);

        # Act:
        $array->removeRange(0, 15);
    }

    /**
     * @test
    */
    public function RemoveRange_CanRemoveRangeOfElements() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeRange(1, 2);

        # Assert:
        $this->assertEquals(1, $array->count());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Repeat_ThrowsExceptionWhenCountIsLessThanZero() {
        # Arrange:
        # Act:
        ArrayList::repeat('dotnetonphp', -1);
    }

    /**
     * @test
    */
    public function Repeat_CanCreateArrayListFromObject() {
        # Arrange:
        $array = ArrayList::repeat('dotnetonphp', 10);

        # Act:
        $result = $array->count();

        # Assert:
        $this->assertEquals(10, $result);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Reverse_ThrowsExceptionWhenListIsReadOnly() {

        # Arrange:
        $array = ArrayList::readOnly(new ArrayList);

        # Act:
        $array->reverse();
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Reverse_ThrowsExceptionWhenIndexIsLessThanZero() {

        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(-1, 2);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Reverse_ThrowsExceptionWhenCountIsLessThanZero() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(2, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Reverse_ThrowsExceptionWhenIsInvalidRange() {
     
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(2, 10);
    }

    /**
     * @test
    */
    public function Reverse_CanReverseAllElements() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse();

        # Assert:
        $this->assertEquals('php', $array->get(0));
    }

    /**
     * @test
    */
    public function Reverse_CanReversePartOfElements() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(0, 2);

        # Assert:
        $this->assertEquals('net', $array->get(0));
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function SetRange_ThrowsExceptionWhenIndexIsLessThanZero() {
      
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->setRange(-1, $this->list);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function SetRange_ThrowsExceptionWhenIsRangeIsInvalid() {

        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->setRange(2, $this->list);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function SetRange_ThrowsExceptionWhenIsReadOnly() {
        
        # Arrange:
        $array = ArrayList::readOnly(new ArrayList);

        # Act:
        $array->setRange(0, $this->list);
    }

    /**
     * @test
    */
    public function SetRange_CanSetRangeOfElements() {
        
        # Arrange:
        $reversedArray = new ArrayList($this->list);
        $reversedArray->reverse();
        $array = new ArrayList($this->list);

        # Act:
        $array->setRange(0, $reversedArray);

        # Assert:
        $this->assertEquals('php', $array->get(0));
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Sort_ThrowsExceptionWhenIsReadOnly() {
        
        # Arrange:
        $array = ArrayList::readOnly(new ArrayList);

        # Act:
        $array->sort();
    }

    /**
     * @test
    */
    public function Sort_ThrowsExceptionWhenTypeOfElementsIsNotEqual() {
        $this->markTestIncomplete("Comparer not implemented");
    }

    /**
     * @test
    */
    public function Sort_CanSortWithComparable() {
        $this->markTestIncomplete("Comparer not implemented");
    }

    /**
     * @test
    */
    public function Sort_CanSortElements() {
        # Arrange:
        $array = new ArrayList($this->list);
        $array->reverse();

        # Act:
        $array->sort();

        # Assert:
        $this->assertEquals('dot', $array->get(0));
    }

    /**
     * @test
    */
    public function ToArray_CanTransformInArray() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->toArray();

        # Assert:
        $this->assertTrue(is_array($result));
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function TrimToSize_ThrowsExceptionWhenIsReadOnly() {
        
        # Arrange:
        $array = ArrayList::readOnly(new ArrayList);

        # Act:
        $array->trimToSize();
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function TrimToSize_ThrowsExceptionWhenIsFixedSize() {
        
        # Arrange:
        $array = ArrayList::fixedSize(new ArrayList);

        # Act:
        $array->trimToSize();
    }

    /**
     * @test
    */
    public function TrimToSize_CanChangeCapacityToSizeOfList() {
        # Arrange:
        $array = new ArrayList($this->list);
        $array->capacity(100);

        # Act:
        $array->trimToSize();

        # Assert:
        $this->assertEquals($array->capacity(), $array->count());
    }
}
