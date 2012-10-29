<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\Collections\Hashtable as Hashtable;
 
class HashtableFixture extends PHPUnit_Framework_TestCase {

    public function test_Construct_ConstructFromDictionary() {
        $hash = new Hashtable;
        $hash->add("a", 1);
        $hash->add("b", 2);
        $new_hash = new Hashtable($hash);
        $this->assertEquals(2, $new_hash->count());
    }

    public function test_Add_ThrowsExceptionWhenKeyIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $hash = new Hashtable();
        $hash->add(null, "a");
    }

    public function test_Add_ThrowsExceptionWhenKeyAlreadyExists() {
        $this->setExpectedException("\\System\\ArgumentException");
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(1, "b");
    }

    public function test_Add_ThrowsExceptionWhenHashtableIsReadOnly() {
        $this->markTestSkipped("This method not implemented");
    }

    public function test_Add_ThrowsExceptionWhenHashtableIsFixedSize() {
        $this->markTestSkipped("This method not implemented");
    }

    public function test_Add_CanAddElementInHashtable() {
        $hash = new Hashtable;
        $hash->add(1, "b");
        $this->assertEquals(1, $hash->count());
    }

    public function test_Clear_ThrowsExceptionWhenHashtableIsReadOnly() {
        $this->markTestSkipped("This method not implemented");
    }

    public function test_Clear_CanClearAllElements() {
        $hash = new Hashtable;
        $hash->add(1, "b");
        $hash->clear();
        $this->assertEquals(0, $hash->count());
    }

    public function test_Contains_ThrowsExceptionWhenKeyIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $hash = new Hashtable;
        $hash->containsKey(null);
    }

    public function test_Contains_ReturnTrueIfKeyExists() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $this->assertEquals(true, $hash->containsKey(1));
    }

    public function test_Contains_ReturnFalseIfKeyNotExists() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $this->assertEquals(false, $hash->containsKey(3));
    }


    public function test_ContainsValue_ReturnTrueIfValueExists() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $this->assertEquals(true, $hash->containsValue("a"));
    }

    public function test_ContainsValue_ReturnFalseIfValueNotExists() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $this->assertEquals(false, $hash->containsValue("c"));
    }

    public function test_CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $array = array();
        $hash->copyTo($array, -1);
    }

    public function test_CopyTo_CanCopyElementsFromHashtable() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $array = array();
        $hash->copyTo($array, 0);
        $this->assertEquals(2, sizeof($array));
    }

    public function test_Remove_ThrowsExceptionWhenArgumentIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->remove(null);
    }

    public function test_Remove_ThrowsExceptionWhenHashtableIsReadOnly() {
        $this->markTestSkipped("This method not implemented.");
    }

    public function test_Remove_ThrowsExceptionWhenHashtableIsFixedSize() {
        $this->markTestSkipped("This method not implemented.");
    }

    public function test_Remove_CanRemoveElements() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $hash->remove(1);
        $this->assertEquals(1, $hash->count());
    }

    public function test_Keys_GetAllKeys() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $this->assertEquals(2, sizeof($hash->keys()));
    }

    public function test_Values_GetAllValues() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $this->assertEquals(2, sizeof($hash->values()));
    }

    public function test_Get_CanGetElement() {
        $hash = new Hashtable;
        $hash->add(1, "b");
        $this->assertEquals("b", $hash->get(1));
    }

    public function test_Set_CanSetElement() {
        $hash = new Hashtable;
        $hash->add(1, "b");
        $hash->set(1, "a");
        $this->assertEquals("a", $hash->get(1));
    }

    public function test_GetEnumerator_GetFromHashtable() {
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        $enumerator = $hash->getEnumerator();
        $enumerator->moveNext();
        $this->assertEquals("a", $enumerator->current());
    }

}
?>

