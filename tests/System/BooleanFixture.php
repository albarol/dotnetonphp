<?php

require_once dirname(__FILE__) . '/../../system/Boolean.php';

class BooleanFixture extends PHPUnit_Framework_TestCase {

    public function testCanGetFalseString() {
        $this->assertEquals("False", Boolean::FalseString);
    }
    
    public function testCanGetTrueString() {
        $this->assertEquals("True", Boolean::TrueString);
    }

    public function testWhenCompareTrueWithFalseShouldReturnGreaterZero() {
        $true = new Boolean(true);
        $this->assertEquals(1, $true->compareTo(false));
    }

    public function testWhenCompareTrueWithTrueShouldReturnZero() {
        $true = new Boolean(true);
        $this->assertEquals(0, $true->compareTo(true));
    }

    public function testWhenCompareFalseWithFalseShouldReturnZero() {
        $false = new Boolean();
        $this->assertEquals(0, $false->compareTo(false));
    }

    public function testWhenCompareFalseWithTrueShouldReturnLessZero() {
        $false = new Boolean();
        $this->assertEquals(-1, $false->compareTo(true));
    }

    public function testCanGetFalseHashCode() {
        $false = new Boolean();
        $this->assertEquals(0, $false->getHashCode());
    }

    public function testCanGetTrueHashCode() {
        $false = new Boolean(true);
        $this->assertEquals(1, $false->getHashCode());
    }

    public function testGetTypeCode() {
        $code = Code::boolean();
        $bool = new Boolean();
        $this->assertEquals($code, $bool->getTypeCode());
    }

    public function testWhenTryParseTrueStringShouldReturnTrueBoolean() {
        $true = Boolean::parse("True");
        $this->assertEquals(true, $true->value);
    }

    public function testWhenTryParseFalseStringShouldReturnFalseBoolean() {
        $false = Boolean::parse("False");
        $this->assertEquals(false, $false->value);
    }

    public function testCantParseBooleanValuesBecauseArgumentIsNull() {
        $this->setExpectedException("ArgumentNullException");
        $bool = Boolean::parse(null);
    }

    public function testCantParseBooleanValuesBecauseArgumentHasInvalidFormat() {
        $this->setExpectedException("FormatException");
        $bool = Boolean::parse("a");
    }

    public function testCanConvertTrueInString() {
        $true = new Boolean(true);
        $this->assertEquals("True", $true->toString());
    }

    public function testCanConvertFalseInString() {
        $false = new Boolean();
        $this->assertEquals("False", $false->toString());
        
    }

    public function testCanTryParseBooleanValue() {
        $result = true;
        $bool = Boolean::tryParse("False", $result);
        $this->assertEquals(true, $bool);
        $this->assertEquals(false, $result);
    }

    public function testWhenTryParseNullValueShouldReturnFalse() {
        $result = null;
        $bool = Boolean::tryParse(null, $result);
        $this->assertNull($result);
        $this->assertEquals(false, $bool);
    }

}

?>
