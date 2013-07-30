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
     */
     public function Count_ShouldGetNumberOfElements() {

         # Arrange:
        $dict = new Dictionary;

         # Act:
        $dict->add("key", "value");

         # Assert:
        $this->assertEquals(1, $dict->count());
     }

}
