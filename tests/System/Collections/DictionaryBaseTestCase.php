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

     /**
      * @test
     */
     public function Clear_ShouldClearAllElements() {

         # Arrange:
         $dict = new Dictionary;
         $dict->add("key", "value");

         # Act:
         $dict->clear();

         # Assert:
         $this->assertEquals(0, $dict->count());
     }

     /**
      * @test
      * @expectedException \System\ArgumentNullException
     */
     public function Contains_ThrowsExceptionWhenKeyIsNull() {

        # Arrange:
        $dict = new Dictionary;

        # Act:
        $dict->contains(null);
     }

     /**
      * @test
     */
     public function Contains_ShouldTrueIfElementExists() {

        # Arrange:
        $dict = new Dictionary;
        $dict->add("key", "value");

         # Act:
        $result = $dict->contains("key");

         # Assert:
        $this->assertTrue($result);
     }

    /**
     * @test
    */
    public function Contains_ShouldFalseIfElementDoesNotExists() {
    
        # Arrange:
        $dict = new Dictionary;
        $dict->add("key", "value");

        # Act:
        $result = $dict->contains("value");

        # Assert:
        $this->assertFalse($result);

    }

     /**
      * @test
      * @expectedException \System\ArgumentOutOfRangeException
     */
     public function CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() {
     
         # Arrange:
         $dict = new Dictionary;
     
         # Act:
         $dict->copyTo(-1);
     }

     /**
      * @test
      * @expectedException \System\ArgumentException
     */
     public function CopyTo_ThrowsExceptionWhenIndexIsEqualLengthOfArray() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 1);
     
         # Act:
         $dict->copyTo(1);
     }

    /**
      * @test
      * @expectedException \System\ArgumentException
     */
     public function CopyTo_ThrowsExceptionWhenIndexIsGreatherLengthOfArray() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 1);
     
         # Act:
         $dict->copyTo(2);
     }

     /**
      * @test
     */
     public function CopyTo_ShouldCopyAllElements() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 'value');
         $dict->add('value', 'key');
     
         # Act:
         $el = $dict->copyTo();
     
         # Assert:
         $this->assertEquals(2, sizeof($el));
     }

     /**
      * @test
     */
     public function CopyTo_ShouldCopyPartOfElements() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 'value');
         $dict->add('value', 'key');
     
         # Act:
         $el = $dict->copyTo(1);
     
         # Assert:
         $this->assertEquals(1, sizeof($el));
     }

     /**
      * @test
     */
     public function Count_ShouldGetNumberOfElements() {

         # Arrange:
        $dict = new Dictionary;

         # Act:
        $dict->add("key", "value");

         # Assert:
        $this->assertEquals(1, $dict->count());
     }

     /**
      * @test
     */
     public function Equals_ShouldReturnTrueIfObjectIsTheSame() {
     
         # Arrange:
         $dict = new Dictionary;
     
         # Act:
         $result = $dict->equals($dict);
     
         # Assert:
         $this->assertTrue($result);
     }

     /**
      * @test
     */
     public function Equals_ShouldReturnFalseWhenObjectIsDifferent() {
     
         # Arrange:
         $dic1 = new Dictionary;
         $dic2 = new Dictionary;
     
         # Act:
         $result = $dic1->equals($dic2);
     
         # Assert:
         $this->assertFalse($result);
     }

     /**
      * @test
      * @expectedException \System\ArgumentNullException
     */
     public function Get_ThrowsExceptionWhenKeyIsNull() {
     
         # Arrange:
         $dict = new Dictionary;
     
         # Act:
         $dict->get(null);
     }

     /**
      * @test
      * @expectedException \System\Collections\KeyNotFoundException
     */
     public function Get_ThrowsExceptionWhenKeyNotFound() {
     
         # Arrange:
         $dict = new Dictionary;
     
         # Act:
         $dict->get('key');
     }

     /**
      * @test
     */
     public function Get_ShouldReturnElement() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 1);
     
         # Act:
         $value = $dict->get('key');
     
         # Assert:
         $this->assertEquals(1, $value);
     }

     /**
      * @test
     */
     public function Keys_ShouldGetAllKeysFromDictionary() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 'value');
         $dict->add('key2', 'value2');
     
         # Act:
         $keys = $dict->keys();

         # Assert:
         $this->assertEquals(2, sizeof($keys));
     }

     /**
      * @test
      * @expectedException \System\ArgumentNullException
     */
     public function Set_ThrowsExceptionWhenKeyIsNull() {
     
         # Arrange:
         $dict = new Dictionary;

         # Act:
         $dict->set(null, 'value');
     }

     /**
      * @test
      * @expectedException \System\Collections\KeyNotFoundException
     */
     public function Set_ThrowsExceptionWhenKeyNotFound() {
     
         # Arrange:
         $dict = new Dictionary;

         # Act:
         $dict->set('key', 'value');
     }

     /**
      * @test
     */
     public function Set_ShouldReplaceValueInSpecificKey() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 'value');
     
         # Act:
         $dict->set('key', 1);
     
         # Assert:
         $this->assertEquals(1, $dict->get('key'));
     }

     /**
      * @test
      * @expectedException \System\ArgumentNullException
     */
     public function Remove_ThrowsExceptionWhenKeyIsNull() {
     
         # Arrange:
         $dict = new Dictionary;
     
         # Act:
         $dict->remove(null);
     }

     /**
      * @test
     */
     public function Remove_ShouldReturnTrueWhenElementWasRemoved() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 'value');
     
         # Act:
         $result = $dict->remove('key');
     
         # Assert:
         $this->assertTrue($result);
     }

     /**
      * @test
     */
     public function Remove_ShouldReturnFalseWhenElementNotRemoved() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 'value');
     
         # Act:
         $result = $dict->remove('value');
     
         # Assert:
         $this->assertFalse($result);
     }

     /**
      * @test
     */
     public function Values_ShouldGetValuesFromCollection() {
     
         # Arrange:
         $dict = new Dictionary;
         $dict->add('key', 'value');
     
         # Act:
         $values = $dict->values();
     
         # Assert:
        $this->assertEquals('value', $values[0]);
     }
}
