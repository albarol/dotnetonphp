<?php

require_once dirname(__FILE__) . '/../../src/Autoloader.php';

use System\Int32 as Int32;

class Int32Fixture extends PHPUnit_Framework_TestCase {

    public function test_Construct_CanConstructWithAnyValue() {
        # Arrange:
        $param = 123;
        
        # Act:
        $obj = new Int32($param);

        # Assert:
        $this->assertEquals($param, $obj->value());
    }

    public function test_Construct_CanConstructWithMaxValue() {
        # Arrange:
        $max_value = Int32::MAX_VALUE;
        
        # Act:
        $obj = Int32::maxValue();

        # Assert:
        $this->assertEquals($max_value, $obj->value());
    }

    public function test_Construct_CanConstructWithMinValue() {
        # Arrange:
        $max_value = Int32::MIN_VALUE;
        
        # Act:
        $obj = Int32::minValue();

        # Assert:
        $this->assertEquals($max_value, $obj->value());   
    }

    public function test_CompareTo_ShouldMinusOneWhenValueIsLess() {
        # Arrange:
        $obj = Int32::minValue();

        # Act:
        $result = $obj->compareTo(Int32::MAX_VALUE);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_CompareTo_ShouldOneWhenValueIsGreater() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->compareTo(Int32::MIN_VALUE);

        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_CompareTo_ShouldZeroWhenValueIsEqual() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->compareTo(Int32::MAX_VALUE);

        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_CompareTo_ShouldCompareToAnotherInstance() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->compareTo(Int32::maxValue());

        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_Equals_ShouldTrueIfIsEqual() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals(Int32::MAX_VALUE);

        # Assert:
        $this->assertTrue($result);
    }

    public function test_Equals_ShouldFalseIfIsNotEqual() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals(Int32::MIN_VALUE);

        # Assert:
        $this->assertFalse($result);
    }

    public function test_Equals_ShouldFalseIfIsNotValue() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals("Int32::MIN_VALUE");

        # Assert:
        $this->assertFalse($result);
    }

    public function test_Equals_ShouldEqualsAnotherInstance() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals(Int32::maxValue());

        # Assert:
        $this->assertTrue($result);
    }


    public function test_GetTypeCode_CanGetTypeCode() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $code = $obj->getTypeCode();

        # Assert:
        $this->assertEquals("Int32", $code->name());
    }


    public function test_Parse_ThrowsExceptionWhenValueIsNull() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentNullException");
        $param = null;

        # Act:
        $obj = Int32::parse($param);
    }

    public function test_Parse_ThrowsExceptionWhenValueIsNotInt32Value() {
        # Arrange:
        $this->setExpectedException("\\System\\FormatException");
        $param = "invalid_info";

        # Act:
        $obj = Int32::parse($param);
    }

    public function test_Parse_CanParseValue() {
        # Arrange:
        $param = 123456;

        # Act:
        $obj = Int32::parse($param);

        # Arrange:
        $this->assertEquals($param, $obj->value());
    }

    public function test_TryParse_ReturnFalseWhenValueIsInvalid() {
        # Arrange:
        $param = "invalid_info";
        $obj = null;

        # Act:
        $result = Int32::tryParse($param, &$obj);

        # Arrange:
        $this->assertFalse($result);
    }

    public function test_TryParse_ReturnFalseWhenValueIsValid() {
        # Arrange:
        $param = 123456;
        $obj = null;

        # Act:
        $result = Int32::tryParse($param, &$obj);

        # Arrange:
        $this->assertTrue($result);
    }

    public function test_ToString_CanTransformToString() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->toString();

        # Arrange:
        $this->assertEquals("2147483647", $result);
    }
}