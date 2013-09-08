
<?php

use \System\Object as Object;

/**
 * @group core
*/
class ObjectTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function HashCode_ShouldHaveHashCode() {
        # Arrange:
        $obj = new Object();

        # Act:
        $hash_code = $obj->getHashCode();

        # Assert:
        $this->assertGreaterThan(0, $hash_code);
    }

    /**
     * @test
    */
    public function HashCode_ShouldGenerateDiffHashCode() {
        
        # Arrange:
        $objOne = new Object();
        $objTwo = new Object();
    
        # Act:
        # Assert:
        $this->assertNotEquals($objOne->getHashCode(), $objTwo->getHashCode());
    }


    /**
     * @test
    */
    public function Equals_ShouldBeTrueWhenCompareWithSameObject() {
        
        # Arrange:
        $obj = new Object();
        
        # Act:
        # Assert:
        $this->assertTrue($obj->equals($obj));
    }

    /**
     * @test
    */
    public function Equals_ShouldBeFalseWhenCompareWithAnotherObject() {
        # Arrange:
        $obj = new Object();
        
        # Act:
        # Assert:
        $this->assertFalse($obj->equals("obj"));
    }

    /**
     * @test
    */
    public function ToString_ShouldGetNameOfClass() {
        
        # Arrange:
        $obj = new Object();


        # Act:
        # Assert:
        $this->assertEquals("System\Object", $obj->toString());
    }
}
