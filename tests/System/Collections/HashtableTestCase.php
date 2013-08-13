<?php

use \System\Collections\Hashtable as Hashtable;
 
class HashtableTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function Construct_ConstructFromDictionary() 
    {
        
        # Arrange:
        $hash = new Hashtable;
        $hash->add("a", 1);
        $hash->add("b", 2);

        # Act:
        $new_hash = new Hashtable($hash);
        
        # Assert:
        $this->assertEquals(2, $new_hash->count());
    }

    /**
     * @test
     */
    public function Construct_ShouldConstructHashtable() 
    {
        
        # Arrange:
        # Act:
        $hash = new Hashtable;
        
        # Assert:
        $this->assertNotNull($hash);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Add_ThrowsExceptionWhenKeyIsNull() 
    {
        
        # Arrange:
        $hash = new Hashtable;
        $key = null;

        # Act:        
        $hash->add($key, "a");
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
     */
    public function Add_ThrowsExceptionWhenKeyAlreadyExists() 
    {
        
        # Arrange:
        $hash = new Hashtable;
        $key = 1;
        $hash->add($key, "a");

        # Act:        
        $hash->add($key, "b");
    }

    /**
     * @test
     */
    public function Add_CanAddElementInHashtable() 
    {
        # Arrange:
        $hash = new Hashtable;
        
        # Act:
        $hash->add(1, "b");
        
        # Assert:
        $this->assertEquals(1, $hash->count());
    }

    /**
     * @test
     */
    public function Clear_CanClearAllElements() {
        
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "b");
        
        # Act:
        $hash->clear();

        # Assert:
        $this->assertEquals(0, $hash->count());
    }

    /**
     * @test
     */
    public function Clone_ShouldCloneObject() {
        
        # Arrange:
        $hash = new Hashtable;
    
        # Act:
        $new_hash = $hash->cloneObject();
    
        # Assert:
        $this->assertNotNull($new_hash);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function ContainsKey_ThrowsExceptionWhenKeyIsNull() 
    {
        # Arrange:
        $hash = new Hashtable;

        # Act:
        $hash->containsKey(null);
    }

    /**
     * @test
     */
    public function ContainsKey_ShouldReturnTrueIfExists() {
        
        # Arrange:
        $hash = new Hashtable;
        
        # Act:
        $hash->add(1, "a");

        # Assert:
        $this->assertEquals(true, $hash->containsKey(1));
    }

    /**
     * @test
     */
    public function ContainsKey_ShouldReturnFalseIfNotExists() {
        
        # Arrange:
        $hash = new Hashtable;
        
        # Act:
        $hash->add(1, "a");

        # Assert:
        $this->assertEquals(false, $hash->containsKey(3));
    }


    /**
     * @test
     */
    public function ContainsValue_ShouldReturnTrueIfExists() {
        
        # Arrange:
        $hash = new Hashtable;
        
        # Act:
        $hash->add(1, "a");
        
        # Assert:
        $this->assertEquals(true, $hash->containsValue("a"));
    }

    /**
     * @test
     */
    public function ContainsValue_ShouldReturnFalseIfNotExists() {
        # Arrange:
        $hash = new Hashtable;
        
        # Act:
        $hash->add(1, "a");
        
        # Assert:
        $this->assertEquals(false, $hash->containsValue("c"));
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function CopyTo_ThrowsExceptionWhenIndexIsLessThanZero() 
    {
        # Arrange:
        $hash = new Hashtable;
        
        # Act:
        $hash->copyTo(-1);
    }

    /**
     * @test
     */
    public function CopyTo_CanCopyElementsFromHashtable() 
    {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        
        # Act:
        $buffer = $hash->copyTo();

        # Assert:
        $this->assertEquals(1, sizeof($buffer));
    }

    /**
     * @test
     */
    public function CopyTo_CanCopyPartOfElementsFromHashtable() 
    {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");
        
        # Act:
        $buffer = $hash->copyTo(1);

        # Assert:
        $this->assertEquals(1, sizeof($buffer));
    }

    /**
     * @test
     */
    public function Count_ShouldReturnGreaterThanZero() 
    {
        
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, 1);

        # Act:
        $result = $hash->count();
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function Count_ShouldReturnZero() {
        
        # Arrange:
        $hash = new Hashtable;

        # Act:
        $result = $hash->count();
    
        # Assert:
        $this->assertEquals(0, $result);
    }


    /**
     * @test
     */
    public function Equals_ShouldFalseWhenNotEquals() {
        
        # Arrange:
        $first_hash = new Hashtable;
        $first_hash->add(1, 1);
        $second_hash = new Hashtable;
    
        # Act:
        $result = $first_hash->equals($second_hash);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function Equals_ShouldTrueWhenEquals() {
        
        # Arrange:
        $first_hash = new Hashtable;
        $second_hash = new Hashtable;
    
        # Act:
        $result = $first_hash->equals($second_hash);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Get_ThrowsExceptionWhenKeyIsNull() {
        
        # Arrange:
        $hash = new Hashtable;
    
        # Act:
        $hash->get(null);
    }

    /**
     * @test
     */
    public function Get_CanGetElement() {
        
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "b");
        
        # Act:
        $value = $hash->get(1);
        
        # Assert:
        $this->assertEquals("b", $value);
    }

    /**
     * @test
     */
    public function GetEnumerator_GetFromHashtable() {
        
        # Arrange:
        $class_type = '\\System\\Collections\\IEnumerator';
        $hash = new Hashtable;
        $hash->add(1, "a");

        # Act:
        $enumerator = $hash->getEnumerator();
       
        # Assert:
        $this->assertInstanceOf($class_type, $enumerator);
    }

    /**
     * @test
     */
    public function Keys_ShouldReturnZeroWhenHashtableIsEmpty() 
    {
        # Arrange:
        $hash = new Hashtable;

        # Act:
        $keys = $hash->keys();

        # Assert:
        $this->assertEquals(0, sizeof($keys));
    }

    /**
     * @test
     */
    public function Keys_GetAllKeys() 
    {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        $hash->add(2, "b");

        # Act:
        $keys = $hash->keys();

        # Assert:
        $this->assertEquals(2, sizeof($keys));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Remove_ThrowsExceptionWhenArgumentIsNull() 
    {
        # Arrange:
        $hash = new Hashtable;

        # Act:
        $hash->remove(null);
    }


    /**
     * @test
     */
    public function Remove_CanRemoveElements() 
    {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");

        # Act:
        $hash->remove(1);
        
        # Assert:
        $this->assertEquals(0, $hash->count());
    }

    

    /**
     * @test
     */
    public function Values_GetAllValues() 
    {
        # Arrange:
        $hash = new Hashtable;
        $hash->add(1, "a");
        
        # Act:
        $values = $hash->values();

        # Assert:
        $this->assertEquals('a', $values[0]);
    }

    
    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Set_ThrowsExceptionWhenKeyIsNull() 
    {
        
        # Arrange:
        $hash = new Hashtable;
        $key = null;
    
        # Act:
        $hash->set($key, 'a');
    }

    /**
     * @test
     */
    public function Set_CanSetElement() 
    {
       # Arrange:
        $hash = new Hashtable;
        $hash->add(1, 2);
    
        # Act:
        $hash->set(1, 'a');
    
        # Assert:
        $this->assertEquals('a', $hash->get(1));
    }

    /**
     * @test
     */
    public function Set_ShouldAddElementWhenNotExists() 
    {
       # Arrange:
        $hash = new Hashtable;
    
        # Act:
        $hash->set(1, 'a');
    
        # Assert:
        $this->assertEquals('a', $hash->get(1));
    }
}
