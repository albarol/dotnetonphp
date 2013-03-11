<?php

use \System\Char as Char;
use \System\TypeCode as TypeCode;

/**
 * @group core
*/
class CharTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function CompareTo_ShouldBeZeroWhenValuesIsEqual() {
        # Arrange:
        $obj = Char::maxValue();

        # Act:
        $result = $obj->compareTo(Char::MaxValue);

        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function CompareTo_ShouldBeMinusOneWhenInstanceIsGreater() {
        # Arrange:
        $obj = Char::maxValue();

        # Act:
        $result = $obj->compareTo(Char::MinValue);

        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function CompareTo_ShouldBeMinusOneWhenInstanceIsLess() {
        # Arrange:
        $obj = Char::minValue();

        # Act:
        $result = $obj->compareTo(Char::MaxValue);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
     */
    public function Equals_ShouldBeEqualWhenValueIsEqual() {
        # Arrange:
        $obj = Char::minValue();

        # Act:
        $result = $obj->equals(Char::MinValue);

        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function MaxValue_CanGetCharWithMaxValue() {
        # Arrange:
        $obj = Char::maxValue();

        # Assert:
        $this->assertEquals(Char::MaxValue, $obj->value());
    }

    /**
     * @test
     */
    public function MinValue_CanGetCharWithMinValue() {
        
        # Arrange:
        $obj = Char::minValue();

        # Assert:
        $this->assertEquals(Char::MinValue, $obj->value());
    }

    /**
     * @test
     */
    public function GetTypeCode_ShouldBeCharTypeCode() {
        
        # Arrange:
        $obj = Char::minValue();
        $instance_type = 'System\\TypeCode';
    
        # Act:
        $type_code = $obj->getTypeCode();
    
        # Assert:
        $this->assertInstanceOf($instance_type, $type_code);
    }
}
