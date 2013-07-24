<?php

use \System\Collections\DictionaryBase as DictionaryBase;
use \System\Collections\Dictionary as Dictionary;

/**
 * @group collections
*/
class DictionaryBaseFixture extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function Add_CanAddElement() {
        
        # Arrange:
        $dict = new Dictionary;

        # Act:
        $dict->add("name", "dotnetonphp");

        # Assert:
        $this->assertEquals(1, $dict->count());
    }

    /**
      * @test
      * @expectedException \System\ArgumentNullException
     */
     public function Add_ThrowsExceptionWhenKeyIsNull() {

         # Arrange:
        $dict = new Dictionary;

         # Act:
        $dict->add(null, 1);
     }

     /**
      * @test
      * @expectedException \System\ArgumentException
     */
     public function Add_ThrowsExceptionWhenKeyExists() {

         # Arrange:
        $dict = new Dictionary;

         # Act:
        $dict->add("name", "dotnetonphp");
        $dict->add("name", "php");
     }

    /*public function testClearElements() {
        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(2, $dict->count());
        $dict->clear();
        $this->assertEquals(0, $dict->count());
    }

    public function testContainsKey() {
        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(2, $dict->count());
        $this->assertEquals(true, $dict->containsKey("name"));
        $this->assertEquals(false, $dict->containsKey("dateOfBirth"));
    }

    public function testContainsValue() {
        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(2, $dict->count());
        $this->assertEquals(true, $dict->containsValue(23));
        $this->assertEquals(false, $dict->containsValue(42));
    }

    public function testCount() {
        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(2, $dict->count());
    }

    public function testGetKeys() {
        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(2, $dict->count());

        $keys = $dict->getKeys();
        $this->assertEquals("name", $keys[0]);
        $this->assertEquals("age", $keys[1]);
    }

    
    public function testGetValues() {
        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(2, $dict->count());

        $values = $dict->getValues();
        $this->assertEquals("Alexandre", $values[0]);
        $this->assertEquals(23, $values[1]);
    }

    public function testGetElement() {
        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(23, $dict->get("age"));
    }

    public function testCantGetElement() {
        $this->setExpectedException("InvalidArgumentException");

        $dict = new Dictionary();
        $dict->add("name", "Alexandre");
        $dict->add("age", 23);
        $this->assertEquals(23, $dict->get("dateOfBirth"));
    }*/
}
