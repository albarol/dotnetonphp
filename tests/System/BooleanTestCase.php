<?php

use \System\Boolean as Boolean;
use \System\TypeCode as TypeCode;

/**
 * @group core
*/
class BooleanTestCase extends PHPUnit_Framework_TestCase {
    
    /**
     * @test
     */
    public function CompareTo_ShouldEqualWhenCompareSameFalseValue() {
        
        # Arrange:
        $obj = new Boolean();
    
        # Act:
        $result = $obj->compareTo(false);
    
        # Assert:
        $this->assertEquals(0, $result);
    }


    /**
     * @test
     */
    public function CompareTo_ShouldEqualWhenCompareSameTrueValue() {
        
        # Arrange:
        $obj = new Boolean(true);
    
        # Act:
        
        $result = $obj->compareTo(true);

        # Assert:
        $this->assertEquals(0, $result);
    }


    /**
     * @test
     */
    public function CompareTo_ShouldBeOneWhenTrueInstanceCompareWithFalseValue() {
        
        # Arrange:
        $obj = new Boolean(true);
    
        # Act:
        $result = $obj->compareTo(false);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function CompareTo_InstanceTrueWithValueFalseShouldBeOne() {
        
        # Arrange:
        $obj = new Boolean(true);

        # Act:
        $result = $obj->compareTo(false);

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function CompareTo_InstanceFalseWithValueTrueShouldBeMinusOne() {
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->compareTo(true);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
     */
    public function Equals_ShouldTrueIfIsEqual() {
        
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->equals(false);

        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Equals_ShouldFalseIfIsNotEqual() {
        
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->equals(true);

        # Assert:
        $this->assertFalse($result);
    }


    /**
     * @test
     */
    public function GetHashCode_GetHashCodeFalseWhenInstanceIsFalse() {
        
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->getHashCode();

        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function GetHashCode_GetHashCodeTrueWhenInstanceIsTrue() {
        
        # Arrange:
        $obj = new Boolean(true);

        # Act:
        $result = $obj->getHashCode();

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function GetTypeCode_CanGetTypeCode() {
        
        # Arrange:
        $code = TypeCode::boolean();
        $obj = new Boolean();
        
        # Act:
        $result = $obj->getTypeCode();

        #Assert:
        $this->assertEquals($code, $result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Parse_ThrowsExceptionWhenArgumentIsNull() {
        
        # Arrange:
        # Act:
        $obj = Boolean::parse(null);
    }

    /**
     * @test
     * @expectedException \System\FormatException
     */
    public function Parse_ThrowsExceptionWhenArgumentIsInvalid() {
        
        # Arrange:
        # Act:
        $obj = Boolean::parse("a");
    }

    /**
     * @test
     */
    public function Parse_CanParseFalseString() {
        
        # Arrange:
        $str = "False";

        # Act:
        $obj = Boolean::parse($str);

        # Assert:
        $this->assertFalse($obj->value());
    }

    /**
     * @test
     */
    public function Parse_CanParseTrueString() {
        
        # Arrange:
        $str = "True";

        # Act:
        $obj = Boolean::parse($str);

        # Assert:
        $this->assertTrue($obj->value());
    }

    /**
     * @test
     */
    public function TryParse_CanParseTrueString() {
        
        # Arrange:
        $str = "True";

        # Act:
        $obj = Boolean::tryParse($str);

        # Assert:
        $this->assertTrue($obj['result']);
        $this->assertTrue($obj['object']);
    }

    /**
     * @test
     */
    public function TryParse_CanParseFalseString() {
        
        # Arrange:
        $str = "False";

        # Act:
        $obj = Boolean::tryParse($str);

        # Assert:
        $this->assertTrue($obj['result']);
        $this->assertFalse($obj['object']);
    }

    /**
     * @test
     */
    public function TryParse_CantParseInvalidString() {
        
        # Arrange:
        $str = "AAAA";

        # Act:
        $obj = Boolean::tryParse($str);

        # Assert:
        $this->assertFalse($obj['result']);
        $this->assertNull($obj['object']);
    }    

  
    /**
     * @test
     */
    public function ToString_CanConvertToTrueString() {
        
        # Arrange:
        $obj = new Boolean(true);

        # Act:
        $str = $obj->toString();

        # Assert:
        $this->assertEquals(Boolean::TrueString, $str);
    } 

    /**
     * @test
     */
    public function ToString_CanConvertToFalseString() {
        
        # Arrange:
        $obj = new Boolean();

        # Act:
        $str = $obj->toString();

        # Assert:
        $this->assertEquals(Boolean::FalseString, $str);
    }    
}
