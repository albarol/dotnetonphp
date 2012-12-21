<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');

use \System\Collections\Hashtable as Hashtable;

class HashtableFixture extends PHPUnit_Framework_TestCase {

    public function test_Construct_ConstructFromDictionary() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add("a", 1);
        $hash->add("b", 2);
        
        # Act:
        $new_hash = new Hashtable($hash);
        
        # Assert:
        $this->assertEquals(2, $new_hash->count());
    }

    public function test_Add_ThrowsExceptionWhenKeyIsNull() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentNullException");
        $hash = new Hashtable();

        # Act:
        $hash->add(null, "a");
    }

    public function test_Add_ThrowsExceptionWhenKeyAlreadyExists() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentException");
        $hash = new Hashtable;

        # Act:
        $hash->add(1, "a");
        $hash->add(1, "b");
    }

    public function test_Add_ThrowsExceptionWhenHashtableIsReadOnly() {
        $this->markTestSkipped("This method not implemented");
        // # Arrange:
        // $this->setExpectedException("\\System\\NotSupportedException");
        // $hash = new Hashtable();

        // # Act:
        // $hash->add("a", 1);
    }

    public function test_Add_ThrowsExceptionWhenHashtableIsFixedSize() {
        $this->markTestSkipped("This method not implemented");
        // # Arrange:
        // $this->setExpectedException("\\System\\NotSupportedException");
        // $hash = new Hashtable();

        // # Act:
        // $hash->add("a", 1);
        // $hash->add("basename(path)", 1);
    }

    public function test_Add_CanAddElementInHashtable() {
        # Arrange:
        $hash = new Hashtable;
        
        # Act:
        $hash->add(1, "b");
        
        # Assert:
        $this->assertEquals(1, $hash->count());
    }

    public function test_Clear_ThrowsExceptionWhenHashtableIsReadOnly() {
        $this->markTestSkipped("This method not implemented");
        // # Arrange:
        // $this->setExpectedException("\\System\\NotSupportedException");
        // $hash = new Hashtable;
        
        // # Act:
        // $hash->clear();
    }

    public function test_Clear_CanClearAllElements() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "b");
        
        # Act:
        $hash->clear();
        
        # Assert:
        $this->assertEquals(0, $hash->count());
    }

    public function test_Contains_ThrowsExceptionWhenKeyIsNull() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentNullException");
        $hash = new Hashtable;

        # Act:
        $hash->containsKey(null);
    }

    public function test_Contains_ReturnTrueIfKeyExists() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
       
        # Act:
        $result = $hash->containsKey(1);
        
        # Assert:
        $this->assertEquals(true, $result);
    }

    public function test_Contains_ReturnFalseIfKeyNotExists() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");

        # Act:
        $result = $hash->containsKey(3);
        
        # Assert:
        $this->assertEquals(false, $result);
    }

    public function test_ContainsValue_ReturnTrueIfValueExists() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        
        # Act:
        $result = $hash->containsValue("a");

        # Assert:
        $this->assertEquals(true, $result);
    }

    public function test_ContainsValue_ReturnFalseIfValueNotExists() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        
        # Act:
        $result = $hash->containsValue("b");

        # Assert:
        $this->assertEquals(false, $result);
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $hash = new Hashtable;
        $array = array();

        # Act:
        $hash->copyTo($array, -1);
    }

    public function test_CopyTo_CanCopyElementsFromHashtable() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        $array = array();

        # Act:
        $hash->copyTo($array, 0);

        # Assert:
        $this->assertEquals(1, sizeof($array));
    }

    public function test_Remove_ThrowsExceptionWhenArgumentIsNull() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentNullException");
        $hash = new Hashtable;
        $hash->add(1, "a");

        # Act:
        $hash->remove(null);
    }

    public function test_Remove_ThrowsExceptionWhenHashtableIsReadOnly() {
        $this->markTestSkipped("This method not implemented.");
        // # Arrange:
        // $this->setExpectedException("\\System\\NotSupportedException");
        // $hash = new Hashtable;
        // $hash->add(1, "a");

        // # Act:
        // $hash->remove(1);
    }

    public function test_Remove_ThrowsExceptionWhenHashtableIsFixedSize() {
        $this->markTestSkipped("This method not implemented.");
        // # Arrange:
        // $this->setExpectedException("\\System\\NotSupportedException");
        // $hash = new Hashtable;
        // $hash->add(1, "a");

        // # Act:
        // $hash->remove(1);
    }

    public function test_Remove_CanRemoveElements() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");

        #Act:
        $hash->remove(1);

        # Assert:
        $this->assertEquals(0, $hash->count());
    }

    public function test_Keys_GetAllKeys() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");

        # Act:
        $keys = $hash->keys();

        # Assert:
        $this->assertEquals(2, sizeof($keys));
    }

    public function test_Values_GetAllValues() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");

        # Act:
        $values = $hash->values();

        # Assert:
        $this->assertEquals(2, sizeof($values));
    }

    public function test_Get_CanGetElement() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "b");

        # Act:
        $el = $hash->get(1);
        
        # Assert:
        $this->assertEquals("b", $el);
    }

    public function test_Set_CanSetElement() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "b");

        # Act:
        $hash->set(1, "a");

        # Assert:
        $this->assertEquals("a", $hash->get(1));
    }

    public function test_GetEnumerator_GetFromHashtable() {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");

        # Act:
        $enumerator = $hash->getEnumerator();
        $enumerator->moveNext();

        # Assert:
        $this->assertEquals("a", $enumerator->current());
    }
}
