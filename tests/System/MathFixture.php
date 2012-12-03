<?php

require_once dirname(__FILE__) . '/../../src/Autoloader.php';

use \System\Math as Math;

class MathFixture extends PHPUnit_Framework_TestCase {

    public function test_Abs_CanGetAbsoluteValueFromNegative() {
        
        # Arrange
        $absolute = 1;
                
        # Act:
        $result = Math::abs(-1);
    
        # Assert:
        $this->assertEquals($absolute, $result);

    }

    public function test_Abs_CanGetAbsoluteValueFromPositive() {
        
        # Arrange
        $absolute = 1;
                
        # Act:
        $result = Math::abs(1);
    
        # Assert:
        $this->assertEquals($absolute, $result);

    }

    public function test_Acos_ShouldReturnNanWhenParameterIsGreaterThanOne() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::acos($d);
    
        # Assert:
        $this->assertEquals(NAN, $result);

    }

    public function test_Acos_ShouldReturnNanWhenParameterIsLessThanMinusOne() {
        
        # Arrange
        $d = -2;
                
        # Act:
        $result = Math::acos($d);
    
        # Assert:
        $this->assertEquals(NAN, $result);

    }

    public function test_Acos_ShouldCalculateAcos() {
        
        # Arrange
        $d = 0.5;
                
        # Act:
        $result = Math::acos($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);

    }

    public function test_Asin_ShouldReturnNanWhenParameterIsGreaterThanOne() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::asin($d);
    
        # Assert:
        $this->assertEquals(NAN, $result);

    }

    public function test_Asin_ShouldReturnNanWhenParameterIsLessThanMinusOne() {
        
        # Arrange
        $d = -2;
                
        # Act:
        $result = Math::asin($d);
    
        # Assert:
        $this->assertEquals(NAN, $result);

    }

    public function test_Asin_ShouldCalculateAcos() {
        
        # Arrange
        $d = 0.5;
                
        # Act:
        $result = Math::asin($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);

    }

    public function test_Atan_ShouldReturnNanWhenParameterIsNan() {
        
        # Arrange
        $d = NAN;
                
        # Act:
        $result = Math::atan($d);
    
        # Assert:
        $this->assertEquals(NAN, $result);
        
    }

    public function test_Atan_ShouldCalculateAtan() {
        
        # Arrange
        $d = 0.5;
                
        # Act:
        $result = Math::atan($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
        
    }

}