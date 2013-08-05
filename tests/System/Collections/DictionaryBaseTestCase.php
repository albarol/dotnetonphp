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

     /*
      * @test
     public function Add_ThrowsExceptionWhenDictionaryBaseIsReadOnly() {
         
         # Arrange:
     
         # Act:
     
         # Assert:
     
     }*/

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

     /*
      * @test
      * @expectedException \System\NotSupportedException
     
     public function Clear_ThrowsExceptionWhenDictionaryIsReadOnly() 
     {
         
         # Arrange:
     
         # Act:
     
         # Assert:
     
     }
     */

     /**
      * @test
      * @expectedException \System\ArgumentNullException
     */
     public function ContainsKey_ThrowsExceptionWhenKeyIsNull() {

        # Arrange:
        $dict = new Dictionary;

        # Act:
        $dict->containsKey(null);
     }

     /**
      * @test
     */
     public function ContainsKey_ShouldTrueIfElementExists() {

        # Arrange:
        $dict = new Dictionary;
        $dict->add("key", "value");

         # Act:
        $result = $dict->containsKey("key");

         # Assert:
        $this->assertTrue($result);
     }

    /**
     * @test
    */
    public function ContainsKey_ShouldFalseIfElementDoesNotExists() {
    
        # Arrange:
        $dict = new Dictionary;
        $dict->add("key", "value");

        # Act:
        $result = $dict->containsKey("value");

        # Assert:
        $this->assertFalse($result);

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
}
