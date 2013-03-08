<?php

use System\Int32 as Int32;

/**
 * @group core
*/
class Int32TestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function Construct_CanConstructWithAnyValue() {
        # Arrange:
        $param = 123;
        
        # Act:
        $obj = new Int32($param);

        # Assert:
        $this->assertEquals($param, $obj->value());
    }

    /**
     * @test
    */
    public function Construct_CanConstructWithMaxValue() {
        # Arrange:
        $max_value = Int32::MAX_VALUE;
        
        # Act:
        $obj = Int32::maxValue();

        # Assert:
        $this->assertEquals($max_value, $obj->value());
    }

    /**
     * @test
    */
    public function Construct_CanConstructWithMinValue() {
        # Arrange:
        $max_value = Int32::MIN_VALUE;
        
        # Act:
        $obj = Int32::minValue();

        # Assert:
        $this->assertEquals($max_value, $obj->value());   
    }

    /**
     * @test
    */
    public function CompareTo_ShouldMinusOneWhenValueIsLess() {
        # Arrange:
        $obj = Int32::minValue();

        # Act:
        $result = $obj->compareTo(Int32::MAX_VALUE);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldOneWhenValueIsGreater() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->compareTo(Int32::MIN_VALUE);

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldZeroWhenValueIsEqual() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->compareTo(Int32::MAX_VALUE);

        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
    */
    public function CompareTo_ShouldCompareToAnotherInstance() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->compareTo(Int32::maxValue());

        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
    */
    public function Equals_ShouldTrueIfIsEqual() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals(Int32::MAX_VALUE);

        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
    */
    public function Equals_ShouldFalseIfIsNotEqual() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals(Int32::MIN_VALUE);

        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
    */
    public function Equals_ShouldFalseIfIsNotValue() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals("Int32::MIN_VALUE");

        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
    */
    public function Equals_ShouldEqualsAnotherInstance() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->equals(Int32::maxValue());

        # Assert:
        $this->assertTrue($result);
    }


    /**
     * @test
    */
    public function GetTypeCode_CanGetTypeCode() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $code = $obj->getTypeCode();

        # Assert:
        $this->assertEquals("Int32", $code->name());
    }


    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Parse_ThrowsExceptionWhenValueIsNull() {
        # Arrange:
        $param = null;

        # Act:
        $obj = Int32::parse($param);
    }

    /**
     * @test
     * @expectedException \System\FormatException
    */
    public function Parse_ThrowsExceptionWhenValueIsNotInt32Value() {
        # Arrange:
        $param = "invalid_info";

        # Act:
        $obj = Int32::parse($param);
    }

    /**
     * @test
    */
    public function Parse_CanParseValue() {
        # Arrange:
        $param = 123456;

        # Act:
        $obj = Int32::parse($param);

        # Arrange:
        $this->assertEquals($param, $obj->value());
    }

    /**
     * @test
    */
    public function TryParse_ReturnFalseWhenValueIsInvalid() {
        # Arrange:
        $param = "invalid_info";

        # Act:
        $parse = Int32::tryParse($param);

        # Arrange:
        $this->assertFalse($parse['result']);
    }

    /**
     * @test
    */
    public function TryParse_ReturnFalseWhenValueIsValid() {
        # Arrange:
        $param = 123456;

        # Act:
        $parse = Int32::tryParse($param);

        # Arrange:
        $this->assertTrue($parse['result']);
    }

    /**
     * @test
    */
    public function ToString_CanTransformToString() {
        # Arrange:
        $obj = Int32::maxValue();

        # Act:
        $result = $obj->toString();

        # Arrange:
        $this->assertEquals("2147483647", $result);
    }
}
