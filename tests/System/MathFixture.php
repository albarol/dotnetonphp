<?php

use \System\Math as Math;
use \System\MidpointRounding as MidpointRounding;

/**
 * @group core
*/
class MathFixture extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function Abs_ShouldGetAbsoluteValueFromNegative() {
        
        # Arrange
        $absolute = 1;
                
        # Act:
        $result = Math::abs(-1);
    
        # Assert:
        $this->assertEquals($absolute, $result);
    }

    /**
     * @test
    */
    public function Abs_ShouldGetAbsoluteValueFromPositive() {
        
        # Arrange
        $absolute = 1;
                
        # Act:
        $result = Math::abs(1);
    
        # Assert:
        $this->assertEquals($absolute, $result);
    }

    /**
     * @test
    */
    public function Acos_ShouldReturnNanWhenParameterIsGreaterThanOne() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::acos($d);
    
        # Assert:
        $this->assertTrue(is_nan($result));
    }

    /**
     * @test
    */
    public function Acos_ShouldReturnNanWhenParameterIsLessThanMinusOne() {
        
        # Arrange
        $d = -2;
                
        # Act:
        $result = Math::acos($d);
    
        # Assert:
        $this->assertTrue(is_nan($result));
    }

    /**
     * @test
    */
    public function Acos_ShouldCalculateAcos() {
        
        # Arrange
        $d = 0.5;
                
        # Act:
        $result = Math::acos($d);
    
        # Assert:
        $this->assertFalse(is_nan($result));
    }

    /**
     * @test
    */
    public function Asin_ShouldReturnNanWhenParameterIsGreaterThanOne() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::asin($d);
    
        # Assert:
        $this->assertTrue(is_nan($result));
    }

    /**
     * @test
    */
    public function Asin_ShouldReturnNanWhenParameterIsLessThanMinusOne() {
        
        # Arrange
        $d = -2;
                
        # Act:
        $result = Math::asin($d);
    
        # Assert:
        $this->assertTrue(is_nan($result));
    }

    /**
     * @test
    */
    public function Asin_ShouldCalculateAcos() {
        
        # Arrange
        $d = 0.5;
                
        # Act:
        $result = Math::asin($d);
    
        # Assert:
        $this->assertFalse(is_nan($result));
    }

    /**
     * @test
    */
    public function Atan_ShouldReturnNanWhenParameterIsNan() {
        
        # Arrange
        $d = NAN;
                
        # Act:
        $result = Math::atan($d);
    
        # Assert:
        $this->assertTrue(is_nan($result));
    }

    /**
     * @test
    */
    public function Atan_ShouldCalculateAtan() {
        
        # Arrange
        $d = 0.5;
                
        # Act:
        $result = Math::atan($d);
    
        # Assert:
        $this->assertFalse(is_nan($result));
    }

    /**
     * @test
    */
    public function Atan2_ShouldCalculateAtan2() {
        
        # Arrange
        $x = 2;
        $y = 3;
                
        # Act:
        $result = Math::atan2($x, $y);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }


    /**
     * @test
    */
    public function BigMul_CanMultiplyTwoSpecifiedNumbers() {
        
        # Arrange
        $a = 10000;
        $b = 10000;

        # Act:
        $result = Math::bigMul($a, $b);
    
        # Assert:
        $this->assertEquals(100000000, $result);
    }

    /**
     * @test
    */
    public function Ceiling_CanReturnSmallestIntegerToUp() {
        
        # Arrange
        $d = 11.59;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    /**
     * @test
    */
    public function Ceiling_CanReturnSmallestIntegerToDown() {
        
        # Arrange
        $d = 11.11;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    /**
     * @test
    */
    public function Cos_ShouldCalculateCos() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::cos($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    /**
     * @test
    */
    public function Cosh_ShouldCalculateCosh() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::cosh($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $d);
    }

    /**
     * @test
    */
    public function DivRem_ThrowsExceptionWhenDivisorIsZero() {
        
        # Arrange
        $this->setExpectedException("\\System\\DivideByZeroException");
        $result = 0;
        
        # Act:
        Math::divRem(10, 0);
    }

    /**
     * @test
    */
    public function DivRem_ShouldGetRemider() {
        
        # Arrange
        $result = 0;
                
        # Act:
        $result = Math::divRem(11, 3);
    
        # Assert:
        $this->assertEquals(2, $result);
    }

    /**
     * @test
    */
    public function Exp_ShouldCalculateSpecificPower() {
        
        # Arrange
        $number = 5.7;
                
        # Act:
        $result = Math::exp($number);
    
        # Assert:
        $this->assertEquals(298.86740096706, $result);
    }

    /**
     * @test
    */
    public function Floor_CanReturnLargestIntegerToUp() {
        
        # Arrange
        $d = 11.59;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    /**
     * @test
    */
    public function Floor_CanReturnLargestIntegerToDown() {
        
        # Arrange
        $d = 11.11;
                
        # Act:
        $result = Math::ceiling($d);
    
        # Assert:
        $this->assertEquals(12, $result);     
    }

    /**
     * @test
    */
    public function IeeeRemider_ShouldCalculateIeee() {
        
        # Arrange
        $x = 1;
        $y = 2;
                
        # Act:
        $result = Math::ieeeReminder($x, $y);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function Log_CanCalculateLogarithmBaseE() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::log($d);
    
        # Assert:
        $this->assertEquals(0.69314718055995, $result);
    }

    /**
     * @test
    */
    public function Log10_CanCalculateLogarithmBase10() {
        
        # Arrange
        $d = 2;
                
        # Act:
        $result = Math::log10($d);
    
        # Assert:
        $this->assertEquals(0.30102999566398, $result);
    }

    /**
     * @test
    */
    public function Max_CanReturnMaxNumber() {
        
        # Arrange
        $val1 = 10;
        $val2 = 5;
                
        # Act:
        $result = Math::max($val1, $val2);
    
        # Assert:
        $this->assertEquals($result, $val1);
    }

    /**
     * @test
    */
    public function Min_CanReturnMinNumber() {
        
        # Arrange
        $val1 = 10;
        $val2 = 5;
                
        # Act:
        $result = Math::min($val1, $val2);
    
        # Assert:
        $this->assertEquals($result, $val2);
    }

    /**
     * @test
    */
    public function Pow_CalculatePowerOfNumber() {
        
        # Arrange
        $x = 4;
        $y = 2;
                
        # Act:
        $result = Math::pow($x, $y);
    
        # Assert:
        $this->assertEquals(16, $result);
    }

    /**
     * @test
    */
    public function Round_CanRoundAwayFromZero() {
        
        # Arrange
        $d = 2.57777;
                
        # Act:
        $result = Math::round($d, 0, MidpointRounding::awayFromZero());
    
        # Assert:
        $this->assertEquals(3, $result);
    }

    /**
     * @test
    */
    public function Round_CanRoundToEven() {
        
        # Arrange
        $d = 2.48;
                
        # Act:
        $result = Math::round($d, 0, MidpointRounding::toEven());
    
        # Assert:
        $this->assertEquals(2, $result);
    }

    /**
     * @test
    */
    public function Sign_CanGetSignFromPositiveNumber() {
        
        # Arrange
        $value = 10;
                
        # Act:
        $result = Math::sign($value);
    
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
    */
    public function Sign_CanGetSignFromNegativeNumber() {
        
        # Arrange
        $value = -10;
                
        # Act:
        $result = Math::sign($value);
    
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
    */
    public function Sign_ReturnZeroWhenNumberIsZero() {
        
        # Arrange
        $value = 0;
                
        # Act:
        $result = Math::sign($value);
    
        # Assert:
        $this->assertEquals(0, $value);
        
    }

    /**
     * @test
    */
    public function Sinh_ShouldCalculateSinh() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::sinh($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    /**
     * @test
    */
    public function Sqrt_ShouldCalculateSqrt() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::sqrt($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    /**
     * @test
    */
    public function Tan_ShouldCalculateTan() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::tan($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }

    /**
     * @test
    */
    public function Tanh_ShouldCalculateTanh() {
        
        # Arrange
        $d = 30;
                
        # Act:
        $result = Math::tanh($d);
    
        # Assert:
        $this->assertNotEquals(NAN, $result);
    }
    
    /**
     * @test
    */
    /**
     * @test
    */
    public function Truncate_ShouldCalculateTruncate() {
        
        # Arrange
        $d = 1.1111;
                
        # Act:
        $result = Math::truncate($d);
    
        # Assert:
        $this->assertEquals(1, $result);
    }
}
