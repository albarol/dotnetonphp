<?php

require_once dirname(__FILE__) . '/../../src/Autoloader.php';

use \System\Boolean as Boolean;
use \System\TypeCode as TypeCode;

class BooleanFixture extends PHPUnit_Framework_TestCase {

    public function test_FalseString_ShouldBeEqualFalse() {
        # Arrange:
        $str = "False";

        # Act:
        $result = Boolean::FalseString;

        # Assert:
        $this->assertEquals($str, $result);
    }
    
    public function test_TrueString_ShouldBeEqualTrue() {
        # Arrange:
        $str = "True";

        # Act:
        $result = Boolean::TrueString;

        # Assert:
        $this->assertEquals($str, $result);   
    }

    public function test_CompareTo_InstanceFalseWithValueFalseShouldBeZero() {
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->compareTo(false);

        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_CompareTo_InstanceTrueWithValueTrueShouldBeZero() {
        # Arrange:
        $obj = new Boolean(true);

        # Act:
        $result = $obj->compareTo(true);

        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_CompareTo_InstanceTrueWithValueFalseShouldBeOne() {
        # Arrange:
        $obj = new Boolean(true);

        # Act:
        $result = $obj->compareTo(false);

        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_CompareTo_InstanceFalseWithValueTrueShouldBeMinusOne() {
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->compareTo(true);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_Equals_ShouldTrueIfIsEqual() {
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->equals(false);

        # Assert:
        $this->assertTrue($result);
    }

    public function test_Equals_ShouldFalseIfIsNotEqual() {
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->equals(true);

        # Assert:
        $this->assertFalse($result);
    }


    public function test_GetHashCode_GetHashCodeFalseWhenInstanceIsFalse() {
        # Arrange:
        $obj = new Boolean();

        # Act:
        $result = $obj->getHashCode();

        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_GetHashCode_GetHashCodeTrueWhenInstanceIsTrue() {
        # Arrange:
        $obj = new Boolean(true);

        # Act:
        $result = $obj->getHashCode();

        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_GetTypeCode_CanGetTypeCode() {
        # Arrange:
        $code = TypeCode::boolean();
        $obj = new Boolean();
        
        # Act:
        $result = $obj->getTypeCode();

        #Assert:
        $this->assertEquals($code, $result);
    }

    public function test_Parse_ThrowsExceptionWhenArgumentIsNull() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentNullException");

        # Act:
        $obj = Boolean::parse(null);
    }

    public function test_Parse_ThrowsExceptionWhenArgumentIsInvalid() {
        # Arrange:
        $this->setExpectedException("\\System\\FormatException");

        # Act:
        $obj = Boolean::parse("a");
    }

    public function test_Parse_CanParseFalseString() {
        # Arrange:
        $str = "False";

        # Act:
        $obj = Boolean::parse($str);

        # Assert:
        $this->assertFalse($obj->value());
    }

    public function test_Parse_CanParseTrueString() {
        # Arrange:
        $str = "True";

        # Act:
        $obj = Boolean::parse($str);

        # Assert:
        $this->assertTrue($obj->value());
    }

    public function test_TryParse_CanParseTrueString() {
        # Arrange:
        $str = "True";
        $result = null;

        # Act:
        $obj = Boolean::tryParse($str, &$result);

        # Assert:
        $this->assertTrue($obj);
        $this->assertTrue($result);
    }

    public function test_TryParse_CanParseFalseString() {
        # Arrange:
        $str = "False";
        $result = null;

        # Act:
        $obj = Boolean::tryParse($str, &$result);

        # Assert:
        $this->assertTrue($obj);
        $this->assertFalse($result);
    }

    public function test_TryParse_CantParseInvalidString() {
        # Arrange:
        $str = "AAAA";
        $result = null;

        # Act:
        $obj = Boolean::tryParse($str, &$result);

        # Assert:
        $this->assertFalse($obj);
        $this->assertNull($result);
    }    

  
    public function test_ToString_CanConvertToTrueString() {
        # Arrange:
        $obj = new Boolean(true);

        # Act:
        $str = $obj->toString();

        # Assert:
        $this->assertEquals(Boolean::TrueString, $str);
    } 

    public function test_ToString_CanConvertToFalseString() {
        # Arrange:
        $obj = new Boolean();

        # Act:
        $str = $obj->toString();

        # Assert:
        $this->assertEquals(Boolean::FalseString, $str);
    }    
}

?>
