<?php

require_once dirname(__FILE__) . '/../../src/Autoloader.php';

use \System\Math as Math;
use \System\MidpointRounding as MidpointRounding;


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

    public function test_Atan2_ShouldCalculateAtan2() {
        
        # Arrange
        $x = 2;
        $y = 3;
                
        # Act:
        $result = Math::atan2($x, $y);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }


    public function test_BigMul_CanMultiplyTwoSpecifiedNumbers() {
        
        # Arrange
        $a = 10000;
        $b = 10000;

        # Act:
        $result = Math::bigMul($a, $b);
    
        # Assert:
        $this->assertEquals(100000000, $result);
    }

    public function test_Ceiling_CanReturnSmallestIntegerToUp() {
        
        # Arrange
        $d = 11.59;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    public function test_Ceiling_CanReturnSmallestIntegerToDown() {
        
        # Arrange
        $d = 11.11;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    public function test_Cos_ShouldCalculateCos() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::cos($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    public function test_Cosh_ShouldCalculateCosh() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::cosh($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $d);
    }

    public function test_DivRem_ThrowsExceptionWhenDivisorIsZero() {
        
        # Arrange
        $this->setExpectedException("\\System\\DivideByZeroException");
        $result = 0;
        
        # Act:
        Math::divRem(10, 0, &$result);
    }

    public function test_DivRem_ShouldGetRemider() {
        
        # Arrange
        $result = 0;
                
        # Act:
        Math::divRem(11, 3, &$result);
    
        # Assert:
        $this->assertEquals(2, $result);
    }

    public function test_Exp_ShouldCalculateSpecificPower() {
        
        # Arrange
        $number = 5.7;
                
        # Act:
        $result = Math::exp($number);
    
        # Assert:
        $this->assertEquals(298.86740096706, $result);
    }

    public function test_Floor_CanReturnLargestIntegerToUp() {
        
        # Arrange
        $d = 11.59;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    public function test_Floor_CanReturnLargestIntegerToDown() {
        
        # Arrange
        $d = 11.11;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    public function test_IeeeRemider_ShouldCalculateIeee() {
        
        # Arrange
        $x = 1;
        $y = 2;
                
        # Act:
        $result = Math::ieeeReminder($x, $y);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_Log_CanCalculateLogarithmBaseE() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::log($d);
    
        # Assert:
        $this->assertEquals(0.69314718055995, $result);
    }

    public function test_Log10_CanCalculateLogarithmBase10() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::log10($d);
    
        # Assert:
        $this->assertEquals(0.30102999566398, $result);
    }

    public function test_Max_CanReturnMaxNumber() {
        
        # Arrange
        $val1 = 10;
        $val2 = 5;
                
        # Act:
        $result = Math::max($val1, $val2);
    
        # Assert:
        $this->assertEquals($result, $val1);
    }

    public function test_Min_CanReturnMinNumber() {
        
        # Arrange
        $val1 = 10;
        $val2 = 5;
                
        # Act:
        $result = Math::min($val1, $val2);
    
        # Assert:
        $this->assertEquals($result, $val2);
    }

    public function test_Pow_CalculatePowerOfNumber() {
        
        # Arrange
        $x = 4;
        $y = 2;
                
        # Act:
        $result = Math::pow($x, $y);
    
        # Assert:
        $this->assertEquals(16, $result);
    }

    public function test_Round_CanRoundAwayFromZero() {
        
        # Arrange
        $d = 2.57777;
                
        # Act:
        $result = Math::round($d, 0, MidpointRounding::awayFromZero());
    
        # Assert:
        $this->assertEquals(3, $result);
    }

    public function test_Round_CanRoundToEven() {
        
        # Arrange
        $d = 2.48;
                
        # Act:
        $result = Math::round($d, 0, MidpointRounding::toEven());
    
        # Assert:
        $this->assertEquals(2, $result);
    }

    public function test_Sign_CanGetSignFromPositiveNumber() {
        
        # Arrange
        $value = 10;
                
        # Act:
        $result = Math::sign($value);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_Sign_CanGetSignFromNegativeNumber() {
        
        # Arrange
        $value = -10;
                
        # Act:
        $result = Math::sign($value);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_Sign_ReturnZeroWhenNumberIsZero() {
        
        # Arrange
        $value = 0;
                
        # Act:
        $result = Math::sign($value);
    
        # Assert:
        $this->assertEquals(0, $value);
        
    }

    public function test_Sinh_ShouldCalculateSinh() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::sinh($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    public function test_Sqrt_ShouldCalculateSqrt() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::sqrt($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    public function test_Tan_ShouldCalculateTan() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::tan($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    public function test_Tanh_ShouldCalculateTanh() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::tanh($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    public function test_Truncate_ShouldCalculateTruncate() {
        
        # Arrange
        $d = 1.1111;
                
        # Act:
        $result = Math::truncate($d);
    
        # Assert:
        $this->assertEquals(1, $result);
    }
}