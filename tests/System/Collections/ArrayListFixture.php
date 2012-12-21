<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');


use \System\Collections\ArrayList as ArrayList;
use \System\Collections\Queue as Queue;

class ArrayListFixture extends PHPUnit_Framework_TestCase {

    protected $queue;

    public function setUp() {
        $this->queue = new Queue;
        $this->queue->enqueue('dot');
        $this->queue->enqueue('net');
        $this->queue->enqueue('on');
        $this->queue->enqueue('php');
    }

    public function test_Construct_ThrowsExceptionWhenCapacityIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        new ArrayList(-1);
    }

    public function test_Construct_CanConstructWithCapacity() {
        $array = new ArrayList(1);
        $array->add(10);
        $this->assertEquals(1, $array->count());
    }

    public function test_Constructor_CanCreateFromCollection() {
        $array = new ArrayList($this->queue);
        $this->assertEquals($this->queue->count(), $array->count());
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
        $readOnlyArray->addRange(new Queue);
    }

    public function test_AddRange_ThrowsExceptionWhenIsFixedSize(){
        #Arrange:
        $this->setExpectedException("\\System\\NotSupportedException");
        $fixedArray = ArrayList::fixedSize(new ArrayList);

        #Act:
        $fixedArray->addRange(new Queue);
    }

    public function test_AddRange_CanAddRangeOfElements() {
        #Arrange:
        $array = new ArrayList();

        #Act:
        $array->addRange($this->queue);

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
        $array = new ArrayList;
        $array->add(1);
        $array->clear();
        $this->assertEquals(0, $array->count());
    }

    public function test_Contains_ShouldBeFalseWhenElementNotFound() {
        $array = new ArrayList;
        $array->add(1);
        $this->assertFalse($array->contains('dotnetonphp'));
    }

    public function test_Contains_ShouldBeTrueWhenElementFound() {
        $array = new ArrayList;
        $array->add(1);
        $this->assertTrue($array->contains(1));
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $buffer = array();
        $array->copyTo($buffer, -1);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsGreaterThanSizeOfQueue() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $buffer = array();
        $array->copyTo($buffer, 2);
    }

    public function test_CopyTo_CanCopyArrayListToArray() {
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $buffer = array();
        $array->copyTo($buffer, 0);
        $this->assertEquals(2, sizeof($buffer));
    }

    public function test_CopyTo_CanCopyPartOfArrayListToArray() {
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $buffer = array();
        $array->copyTo($buffer, 1);
        $this->assertEquals(1, sizeof($buffer));
    }

    public function test_Get_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $array->get(-1);
    }

    public function test_Get_ThrowsExceptionWhenIndexIsGreaterThanCount() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->queue);
        $array->get(10);
    }

    public function test_Get_CanGetElement() {
        $array = new ArrayList($this->queue);
        $this->assertEquals('dot', $array->get(0));
    }

    public function test_GetRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $array->getRange(-1, 1);
    }

    public function test_GetRange_ThrowsExceptionWhenCountIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $array->getRange(0, -1);
    }

    public function test_GetRange_ThrowsExceptionWhenCountAndIndexOutOfRange() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new ArrayList;
        $array->getRange(0, 11);
    }

    public function test_GetRange_CanGetRangeFromArrayList() {
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $array->add(3);
        $rangeList = $array->getRange(0, 2);
        $this->assertEquals(2, $rangeList->count());
    }

    public function test_IndexOf_ResultMinusOneWhenNotFound() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(-1, $array->indexOf(20));
    }

    public function test_IndexOf_ResultShouldBeElementPositionWhenFound() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(2, $array->indexOf('on'));
    }

    public function test_IndexOf_ResultMinusOnWhenNotFoundAfterIndex() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(-1, $array->indexOf('dot', 3));
    }

    public function test_IndexOf_ResultShouldBeElementPositionWhenFoundAfterIndex() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(2, $array->indexOf('on', 1));
    }

    public function test_IndexOf_ResultMinusOnWhenNotFoundInRage() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(-1, $array->indexOf('dot', 2, 1));
    }

    public function test_IndexOf_ResultShouldBeElementPositionWhenFoundInRange() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(1, $array->indexOf('net', 0, 2));
    }

    public function test_Insert_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $array->insert(-1, 1);
    }

    public function test_Insert_ThrowsExceptionWhenIndexGreaterThanCount() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $array->insert(10, 1);
    }

    public function test_Insert_ThrowsExceptionWhenIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $readOnlyArray = ArrayList::readOnly(new ArrayList);
        $readOnlyArray->insert(0, 1);
    }

    public function test_Insert_ThrowsExceptionWhenIsFixedSize() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = new ArrayList;
        $readOnlyArray = ArrayList::fixedSize($array);
        $readOnlyArray->insert(0, 1);
    }

    public function test_Insert_CanInsertInStartList() {
        $array = new ArrayList($this->queue);
        $array->insert(0, 10);
        $this->assertEquals(10, $array->get(0));
    }

    public function test_Insert_CanInsertWhenArrayListIsEmpty() {
        $array = new ArrayList;
        $array->insert(0, 10);
        $this->assertEquals(10, $array->get(0));
    }

    public function test_Insert_CanInsertElementInAnyPosition() {
        $array = new ArrayList($this->queue);
        $array->insert(2, 10);
        $this->assertEquals(10, $array->get(2));
    }

    public function test_InsertRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $array->insertRange(-1, $this->queue);
    }

    public function test_InsertRange_ThrowsExceptionWhenIndexGreaterThanCount() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList;
        $array->insertRange(10, $this->queue);
    }

    public function test_InsertRange_ThrowsExceptionWhenIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $readOnlyArray = ArrayList::readOnly(new ArrayList);
        $readOnlyArray->insertRange(0, $this->queue);
    }

    public function test_InsertRange_ThrowsExceptionWhenIsFixedSize() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = new ArrayList;
        $readOnlyArray = ArrayList::fixedSize($array);
        $readOnlyArray->insertRange(0, $this->queue);
    }

    public function test_InsertRange_CanInsertInStartList() {
        $array = new ArrayList($this->queue);
        $array->insertRange(0, $this->queue);
        $this->assertEquals('dot', $array->get(0));
    }

    public function test_InsertRange_CanInsertWhenArrayListIsEmpty() {
        $array = new ArrayList;
        $array->insertRange(0, $this->queue);
        $this->assertEquals('net', $array->get(1));
    }

    public function test_InsertRange_CanInsertElementInAnyPosition() {
        $array = new ArrayList($this->queue);
        $array->insertRange(2, $this->queue);
        $this->assertEquals('dot', $array->get(2));
    }

    public function test_LastIndexOf_ResultMinusOneWhenNotFound() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(-1, $array->lastIndexOf(20));
    }

    public function test_LastIndexOf_ResultShouldBeElementPositionWhenFound() {
        $array = new ArrayList;
        $array->add(1);
        $array->add(2);
        $array->add(3);
        $array->add(1);
        $this->assertEquals(3, $array->lastIndexOf(1));
    }

    public function test_LastIndexOf_ResultMinusOnWhenNotFoundAfterIndex() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(-1, $array->lastIndexOf(3, 3));
    }

    public function test_LastIndexOf_ResultShouldBeElementPositionWhenFoundAfterIndex() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(2, $array->lastIndexOf('on', 1));
    }

    public function test_LastIndexOf_ResultMinusOnWhenNotFoundInRage() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(-1, $array->lastIndexOf(2, 0, 2));
    }

    public function test_LastIndexOf_ResultShouldBeElementPositionWhenFoundInRange() {
        $array = new ArrayList($this->queue);
        $this->assertEquals(1, $array->lastIndexOf('net', 0, 2));
    }

    public function test_Remove_ThrowsExceptionWhenArrayIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->queue));
        $array->remove(1);
    }

    public function test_Remove_ThrowsExceptionWhenArrayIsFixedSize() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->queue));
        $array->remove(1);
    }

    public function test_Remove_CanRemoveElement() {
        $array = new ArrayList($this->queue);
        $array->remove('dot');
        $this->assertEquals(3, $array->count());
    }

    public function test_RemoveAt_ThrowsExceptionWhenArrayIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->queue));
        $array->removeAt(1);
    }

    public function test_RemoveAt_ThrowsExceptionWhenArrayIsFixedSize() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->queue));
        $array->removeAt(1);
    }

    public function test_RemoveAt_CanRemoveElement() {
        $array = new ArrayList($this->queue);
        $array->removeAt(0);
        $this->assertEquals(3, $array->count());
    }

    public function test_RemoveAt_CanReorganizeArrayList() {
        $array = new ArrayList($this->queue);
        $array->removeAt(0);
        $this->assertEquals('net', $array->get(0));
    }

    public function test_RemoveRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->queue);
        $array->removeRange(-1, 1);
    }

    public function test_RemoveRange_ThrowsExceptionWhenCountIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->queue);
        $array->removeRange(0, -1);
    }

    public function test_RemoveRange_ThrowsExceptionWhenRangeIsInvalid() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new ArrayList($this->queue);
        $array->removeRange(0, 15);
    }

    public function test_RemoveRange_ThrowsExceptionWhenArrayListIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->queue));
        $array->removeRange(0, 15);
    }

    public function test_RemoveRange_ThrowsExceptionWhenArrayListIsFixedSize() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->queue));
        $array->removeRange(0, 15);
    }

    public function test_RemoveRange_CanRemoveRangeOfElements() {
        $array = new ArrayList($this->queue);
        $array->removeRange(1, 2);
        $this->assertEquals(1, $array->count());
    }

    public function test_Repeat_ThrowsExceptionWhenCountIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        ArrayList::repeat('dotnetonphp', -1);
    }

    public function test_Repeat_CanCreateArrayListFromObject() {
        $array = ArrayList::repeat('dotnetonphp', 10);
        $this->assertEquals(10, $array->count());
    }

    public function test_Reverse_ThrowsExceptionWhenListIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->queue));
        $array->reverse();
    }

    public function test_Reverse_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->queue);
        $array->reverse(-1, 2);
    }

    public function test_Reverse_ThrowsExceptionWhenCountIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->queue);
        $array->reverse(2, -1);
    }

    public function test_Reverse_ThrowsExceptionWhenIsInvalidRange() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new ArrayList($this->queue);
        $array->reverse(2, 10);
    }

    public function test_Reverse_CanReverseAllElements() {
        $array = new ArrayList($this->queue);
        $array->reverse();
        $this->assertEquals('php', $array->get(0));
    }

    public function test_Reverse_CanReversePartOfElements() {
        $array = new ArrayList($this->queue);
        $array->reverse(0, 2);
        $this->assertEquals('net', $array->get(0));
    }

    public function test_SetRange_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->queue);
        $array->setRange(-1, $this->queue);
    }

    public function test_SetRange_ThrowsExceptionWhenIsRangeIsInvalid() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = new ArrayList($this->queue);
        $array->setRange(2, $this->queue);
    }

    public function test_SetRange_ThrowsExceptionWhenIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->queue));
        $array->setRange(0, $this->queue);
    }

    public function test_SetRange_CanSetRangeOfElements() {
        $reversedArray = new ArrayList($this->queue);
        $reversedArray->reverse();
        $array = new ArrayList($this->queue);
        $array->setRange(0, $reversedArray);
        $this->assertEquals('php', $array->get(0));
    }

    public function test_Sort_ThrowsExceptionWhenIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->queue));
        $array->sort();
    }

    public function test_Sort_ThrowsExceptionWhenTypeOfElementsIsNotEqual() {
        $this->markTestIncomplete("Comparer not implemented");
        $this->setExpectedException("\\System\\ArgumentException");
        $array = new ArrayList;
        $array->add(1);
        $array->add('dotnetonphp');
        $array->add(new Queue);
        //$array->sort(new Comparer());
    }

    public function test_Sort_CanSortWithComparable() {
        $this->markTestIncomplete("Comparer not implemented");
        $array = new ArrayList;
        $array->add(3);
        $array->add(1);
        $array->add(2);
        //$array->sort(new Comparer());
        $this->assertEquals(1, $array->get(0));
    }

    public function test_Sort_CanSortElements() {
        $array = new ArrayList($this->queue);
        $array->reverse();
        $array->sort();
        $this->assertEquals('dot', $array->get(0));
    }

    public function test_ToArray_CanTransformInArray() {
        $array = new ArrayList($this->queue);
        $result = $array->toArray();
        $this->assertTrue(is_array($result));
    }

    public function test_TrimToSize_ThrowsExceptionWhenIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::readOnly(new ArrayList($this->queue));
        $array->trimToSize();
    }

    public function test_TrimToSize_ThrowsExceptionWhenIsFixedSize() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $array = ArrayList::fixedSize(new ArrayList($this->queue));
        $array->trimToSize();
    }

    public function test_TrimToSize_CanChangeCapacityToSizeOfList() {
        $array = new ArrayList($this->queue);
        $array->capacity(100);
        $array->trimToSize();
        $this->assertEquals($array->capacity(), $array->count());
    }
}
?>
