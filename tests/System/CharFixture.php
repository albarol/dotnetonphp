<?php

use \System\Char as Char;
use \System\TypeCode as TypeCode;

/**
 * @group core
*/
class CharFixture extends PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function CompareTo_ShouldBeZeroWhenValuesIsEqual() {
        # Arrange:
        $obj = Char::maxValue();

        # Act:
        $result = $obj->compareTo(Char::MAX_VALUE);

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
        $result = $obj->compareTo(Char::MIN_VALUE);

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
        $result = $obj->compareTo(Char::MAX_VALUE);

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
        $result = $obj->equals(Char::MIN_VALUE);

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
        $this->assertEquals(Char::MAX_VALUE, $obj->value());
    }

    /**
     * @test
     */
    public function MinValue_CanGetCharWithMinValue() {
        # Arrange:
        $obj = Char::minValue();

        # Assert:
        $this->assertEquals(Char::MIN_VALUE, $obj->value());
    }
}
