<?php

require_once dirname(__FILE__) . '/../../src/Autoloader.php';

use \System\Char as Char;
use \System\TypeCode as TypeCode;

class CharFixture extends PHPUnit_Framework_TestCase {

    public function test_CompareTo_ShouldBeZeroWhenValuesIsEqual() {
        # Arrange:
        $obj = Char::maxValue();

        # Act:
        $result = $obj->compareTo(Char::MAX_VALUE);

        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_CompareTo_ShouldBeMinusOneWhenInstanceIsGreater() {
        # Arrange:
        $obj = Char::maxValue();

        # Act:
        $result = $obj->compareTo(Char::MIN_VALUE);

        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_CompareTo_ShouldBeMinusOneWhenInstanceIsLess() {
        # Arrange:
        $obj = Char::minValue();

        # Act:
        $result = $obj->compareTo(Char::MAX_VALUE);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_ConvertFromUtf32_CanConvertLetterA() {
        # Arrange:
        $letter = 0x0041;

        # Act:
        $str = Char::convertFromUtf32($letter);

        # Assert:
        $this->assertEquals('A', $str);
    }


    public function test_Equals_ShouldBeEqualWhenValueIsEqual() {
        # Arrange:
        $obj = Char::minValue();

        # Act:
        $result = $obj->equals(Char::MIN_VALUE);

        # Assert:
        $this->assertTrue($result);
    }

    public function test_MaxValue_CanGetCharWithMaxValue() {
        # Arrange:
        $obj = Char::maxValue();

        # Assert:
        $this->assertEquals(Char::MAX_VALUE, $obj->value());
    }

    public function test_MinValue_CanGetCharWithMinValue() {
        # Arrange:
        $obj = Char::minValue();

        # Assert:
        $this->assertEquals(Char::MIN_VALUE, $obj->value());
    }
}
