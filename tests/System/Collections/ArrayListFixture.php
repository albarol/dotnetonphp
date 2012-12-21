<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\Collections\ArrayList as ArrayList;

class ArrayListFixture extends PHPUnit_Framework_TestCase {

    protected $queue;

    public function setUp() {
        $this->list = new ArrayList;
        $this->list->add('dot');
        $this->list->add('net');
        $this->list->add('on');
        $this->list->add('php');
    }

    public function test_Construct_ThrowsExceptionWhenCapacityIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $list = new ArrayList(-1);
    }

    public function test_Construct_CanConstructWithCapacity() {
        $array = new ArrayList(1);
        $array->add(10);
        $this->assertEquals(1, $array->count());
    }

    public function test_Constructor_CanCreateFromCollection() {
        $array = new ArrayList($this->list);
        $this->assertEquals($this->list->count(), $array->count());
    }

    public function test_Construct_CanCreateWithoutParameter() {
        $array = new ArrayList();
        $this->assertEquals(0, $array->count());
    }

    public function test_Adapter_CanCreateFromList() {
        #Arrange:
        $list = new ArrayList();
        $list->add(1);

        #Act:
        $array = ArrayList::adapter($list);

        #Assert:
        $this->assertEquals(1, $array->count());
    }

    public function test_Add_ThrowsExceptionWhenListIsReadOnly() {
        #Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = new ArrayList;

        #Act:
        $readOnlyArray = ArrayList::readOnly($array);

        #Assert:
        $readOnlyArray->add(1);
    }

    public function test_Add_ThrowsExceptionWhenIsFixedSize() {
        #Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");

        #Act:
        $fixedArray = ArrayList::fixedSize(new ArrayList);

        #Assert:
        $fixedArray->add(1);
    }

    public function test_Add_CanAddElements() {
        #Arrange:
        $list = new ArrayList();

        #Act:
        $list->add("Php");

        #Assert:
        $this->assertEquals(1, $list->count());
    }

    public function test_AddRange_ThrowsExceptionWhenIsReadOnly(){
        #Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = new ArrayList(10);
        $readOnlyArray = ArrayList::readOnly($array);

        #Act:
        $readOnlyArray->addRange(new ArrayList);
    }

    public function test_AddRange_ThrowsExceptionWhenIsFixedSize(){
        #Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $fixedArray = ArrayList::fixedSize(new ArrayList);

        #Act:
        $fixedArray->addRange(new ArrayList);
    }

    public function test_AddRange_CanAddRangeOfElements() {
        #Arrange:
        $array = new ArrayList();

        #Act:
        $array->addRange($this->list);

        #Assert:
        $this->assertEquals(4, $array->count());
    }

    public function test_Clear_ThrowsExceptionWhenIsReadOnly() {
        #Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = new ArrayList();
        $array->add(1);
        $readOnlyArray = ArrayList::readOnly($array);

        #Act:
        $readOnlyArray->clear();
    }

    public function test_Clear_ThrowsExceptionWhenIsFixedSize() {
        #Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = new ArrayList();
        $array->add(1);
        $readOnlyArray = ArrayList::fixedSize($array);

        #Act:
        $readOnlyArray->clear();
    }

    public function test_Clear_CanClearElements() {
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        
        # Act:
        $array->clear();
        
        # Assert:
        $this->assertEquals(0, $array->count());
    }

    public function test_Contains_ShouldBeFalseWhenElementNotFound() {
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        
        # Act:
        $result = $array->contains('dotnetonphp');
        
        # Assert:
        $this->assertFalse($result);
    }

    public function test_Contains_ShouldBeTrueWhenElementFound() {
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        # Act:
        $result = $array->contains(1);
        
        # Assert:
        $this->assertTrue($result);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $buffer = array();
        
        # Act:
        $array->copyTo($buffer, -1);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $buffer = array();
        
        # Act:
        $array->copyTo($buffer, 2);
    }

    public function test_CopyTo_CanCopyArrayListToArray() {
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $buffer = array();
        
        # Act:
        $array->copyTo($buffer, 0);
        
        # Assert:
        $this->assertEquals(2, sizeof($buffer));
    }

    public function test_CopyTo_CanCopyPartOfArrayListToArray() {
        # Arrange:
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $buffer = array();
        
        # Act:
        $array->copyTo($buffer, 1);
        
        # Assert:
        $this->assertEquals(1, sizeof($buffer));
    }

    public function test_Get_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        
        # Act:
        $array->get(-1);
    }

    public function test_Get_ThrowsExceptionWhenIndexIsGreaterThanCount() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->list);
        
        # Act:
        $array->get(10);
    }

    public function test_Get_CanGetFirstElement() {
        # Arrange
        $array = new ArrayList($this->list);

        # Act:
        $el = $array->get(0);

        # Arrange:
        $this->assertEquals('dot', $el);
    }

    public function test_GetRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        
        # Act:
        $result = $array->getRange(-1, 1);
    }

    public function test_GetRange_ThrowsExceptionWhenCountIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        
        # Act:
        $result = $array->getRange(0, -1);
    }

    public function test_GetRange_ThrowsExceptionWhenCountAndIndexOutOfRange() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new ArrayList;
        
        # Act:
        $array->getRange(0, 11);
    }

    public function test_GetRange_CanGetRangeFromArrayList() {
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

    public function test_IndexOf_ResultMinusOneWhenNotFound() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf(20);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_IndexOf_ResultShouldBeElementPositionWhenFound() {
        # Arrange:
        $array = new ArrayList($this->list);
        
        # Act:
        $result = $array->indexOf('on');
        
        # Assert:
        $this->assertEquals(2, $result);
    }

    public function test_IndexOf_ResultMinusOnWhenNotFoundAfterIndex() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf('dot', 3);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_IndexOf_ResultShouldBeElementPositionWhenFoundAfterIndex() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf('on', 1);

        # Assert:
        $this->assertEquals(2, $result);
    }

    public function test_IndexOf_ResultMinusOnWhenNotFoundInRage() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf('dot', 2, 1);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_IndexOf_ResultShouldBeElementPositionWhenFoundInRange() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->indexOf('net', 0, 2);

        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_Insert_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;

        # Act:
        $array->insert(-1, 1);
    }

    public function test_Insert_ThrowsExceptionWhenIndexGreaterThanCount() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;

        # Act:
        $array->insert(10, 1);
    }

    public function test_Insert_ThrowsExceptionWhenIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $readOnlyArray = ArrayList::readOnly(new ArrayList);

        # Act:
        $readOnlyArray->insert(0, 1);        
    }

    public function test_Insert_ThrowsExceptionWhenIsFixedSize() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = new ArrayList;
        $readOnlyArray = ArrayList::fixedSize($array);

        # Act:
        $readOnlyArray->insert(0, 1);
    }

    public function test_Insert_CanInsertInStartList() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insert(0, 10);

        # Assert:
        $this->assertEquals(10, $array->get(0));
    }

    public function test_Insert_CanInsertWhenArrayListIsEmpty() {
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insert(0, 10);

        # Assert:
        $this->assertEquals(10, $array->get(0));
    }

    public function test_Insert_CanInsertElementInAnyPosition() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insert(2, 10);

        # Assert:
        $this->assertEquals(10, $array->get(2));
    }

    public function test_InsertRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");

        # Act:
        $array = new ArrayList;

        # Assert:
        $array->insertRange(-1, $this->list);
    }

    public function test_InsertRange_ThrowsExceptionWhenIndexGreaterThanCount() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");

        # Act:
        $array = new ArrayList;

        # Assert:
        $array->insertRange(10, $this->list);
    }

    public function test_InsertRange_ThrowsExceptionWhenIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");

        # Act:
        $readOnlyArray = ArrayList::readOnly(new ArrayList);

        # Assert:
        $readOnlyArray->insertRange(0, $this->list);
    }

    public function test_InsertRange_ThrowsExceptionWhenIsFixedSize() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");

        # Act:
        $array = new ArrayList;
        $readOnlyArray = ArrayList::fixedSize($array);

        # Assert:
        $readOnlyArray->insertRange(0, $this->list);
    }

    public function test_InsertRange_CanInsertInStartList() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insertRange(0, $this->list);

        # Assert:
        $this->assertEquals('dot', $array->get(0));
    }

    public function test_InsertRange_CanInsertWhenArrayListIsEmpty() {
        # Arrange:
        $array = new ArrayList;

        # Act:
        $array->insertRange(0, $this->list);

        # Assert:
        $this->assertEquals('net', $array->get(1));
    }

    public function test_InsertRange_CanInsertElementInAnyPosition() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->insertRange(2, $this->list);

        # Assert:
        $this->assertEquals('dot', $array->get(2));
    }

    public function test_LastIndexOf_ResultMinusOneWhenNotFound() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf(20);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_LastIndexOf_ResultShouldBeElementPositionWhenFound() {
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

    public function test_LastIndexOf_ResultMinusOnWhenNotFoundAfterIndex() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf(3, 3);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_LastIndexOf_ResultShouldBeElementPositionWhenFoundAfterIndex() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf('on', 1);

        # Assert:
        $this->assertEquals(2, $result);
    }

    public function test_LastIndexOf_ResultMinusOnWhenNotFoundInRage() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf(2, 0, 2);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_LastIndexOf_ResultShouldBeElementPositionWhenFoundInRange() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->lastIndexOf('net', 0, 2);

        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_Remove_ThrowsExceptionWhenArrayIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->list));

        # Act:
        $array->remove(1);
    }

    public function test_Remove_ThrowsExceptionWhenArrayIsFixedSize() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->list));

        # Act:
        $array->remove(1);
    }

    public function test_Remove_CanRemoveElement() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->remove('dot');

        # Assert:
        $this->assertEquals(3, $array->count());
    }

    public function test_RemoveAt_ThrowsExceptionWhenArrayIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->list));

        # Act:
        $array->removeAt(1);
    }

    public function test_RemoveAt_ThrowsExceptionWhenArrayIsFixedSize() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->list));

        # Act:
        $array->removeAt(1);
    }

    public function test_RemoveAt_CanRemoveElement() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeAt(0);

        # Assert:
        $this->assertEquals(3, $array->count());
    }

    public function test_RemoveAt_CanReorganizeArrayList() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeAt(0);

        # Assert:
        $this->assertEquals('net', $array->get(0));
    }

    public function test_RemoveRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->list);

        # Act:
        $array->removeRange(-1, 1);
    }

    public function test_RemoveRange_ThrowsExceptionWhenCountIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->list);

        # Act:
        $array->removeRange(0, -1);
    }

    public function test_RemoveRange_ThrowsExceptionWhenRangeIsInvalid() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new ArrayList($this->list);
        
        # Act:
        $array->removeRange(0, 15);
    }

    public function test_RemoveRange_ThrowsExceptionWhenArrayListIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->list));

        # Act:
        $array->removeRange(0, 15);
    }

    public function test_RemoveRange_ThrowsExceptionWhenArrayListIsFixedSize() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->list));

        # Act:
        $array->removeRange(0, 15);
    }

    public function test_RemoveRange_CanRemoveRangeOfElements() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->removeRange(1, 2);

        # Assert:
        $this->assertEquals(1, $array->count());
    }

    public function test_Repeat_ThrowsExceptionWhenCountIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");

        # Act:
        ArrayList::repeat('dotnetonphp', -1);
    }

    public function test_Repeat_CanCreateArrayListFromObject() {
        # Arrange:
        $array = ArrayList::repeat('dotnetonphp', 10);

        # Act:
        $result = $array->count();

        # Assert:
        $this->assertEquals(10, $result);
    }

    public function test_Reverse_ThrowsExceptionWhenListIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->list));

        # Act:
        $array->reverse();
    }

    public function test_Reverse_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(-1, 2);
    }

    public function test_Reverse_ThrowsExceptionWhenCountIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(2, -1);
    }

    public function test_Reverse_ThrowsExceptionWhenIsInvalidRange() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(2, 10);
    }

    public function test_Reverse_CanReverseAllElements() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse();

        # Assert:
        $this->assertEquals('php', $array->get(0));
    }

    public function test_Reverse_CanReversePartOfElements() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $array->reverse(0, 2);

        # Assert:
        $this->assertEquals('net', $array->get(0));
    }

    public function test_SetRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->list);

        # Act:
        $array->setRange(-1, $this->list);
    }

    public function test_SetRange_ThrowsExceptionWhenIsRangeIsInvalid() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->list);

        # Act:
        $array->setRange(2, $this->list);
    }

    public function test_SetRange_ThrowsExceptionWhenIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->list));

        # Act:
        $array->setRange(0, $this->list);
    }

    public function test_SetRange_CanSetRangeOfElements() {
        # Arrange:
        $reversedArray = new ArrayList($this->list);
        $reversedArray->reverse();
        $array = new ArrayList($this->list);

        # Act:
        $array->setRange(0, $reversedArray);

        # Assert:
        $this->assertEquals('php', $array->get(0));
    }

    public function test_Sort_ThrowsExceptionWhenIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->list));

        # Act:
        $array->sort();
    }

    /*public function test_Sort_ThrowsExceptionWhenTypeOfElementsIsNotEqual() {
        $this->markTestIncomplete("Comparer not implemented");
    }

    public function test_Sort_CanSortWithComparable() {
        $this->markTestIncomplete("Comparer not implemented");
    }*/

    public function test_Sort_CanSortElements() {
        # Arrange:
        $array = new ArrayList($this->list);
        $array->reverse();

        # Act:
        $array->sort();

        # Assert:
        $this->assertEquals('dot', $array->get(0));
    }

    public function test_ToArray_CanTransformInArray() {
        # Arrange:
        $array = new ArrayList($this->list);

        # Act:
        $result = $array->toArray();

        # Assert:
        $this->assertTrue(is_array($result));
    }

    public function test_TrimToSize_ThrowsExceptionWhenIsReadOnly() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->list));

        # Act:
        $array->trimToSize();
    }

    public function test_TrimToSize_ThrowsExceptionWhenIsFixedSize() {
        # Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->list));

        # Act:
        $array->trimToSize();
    }

    public function test_TrimToSize_CanChangeCapacityToSizeOfList() {
        # Arrange:
        $array = new ArrayList($this->list);
        $array->capacity(100);

        # Act:
        $array->trimToSize();

        # Assert:
        $this->assertEquals($array->capacity(), $array->count());
    }
}
