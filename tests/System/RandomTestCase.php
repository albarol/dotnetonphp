<?php

use \System\Random as Random;

/**
 * @group core
*/
class RandomTestCase extends PHPUnit_Framework_TestCase 
{
    /**
     * @test
     * @expectedException \System\OverflowException
    */
    public function Construct_ThrowsExceptionWhenSeedIsMinValue() 
    {
        # Arrange:
        # Act:
        $min_value = -2147483647;
        $rnd = new Random($min_value);
    }

    /**
     * @test
    */
    public function Construct_ShouldCreateClassWithSeed() 
    {
        # Arrange:
        $rnd = new Random(10);
    
        # Act:
        $number = $rnd->next();
    
        # Assert:
        $this->assertTrue($number <= 10);
    }


    /**
     * @test
    */
    public function Equals_ShouldBeTrueWhenInstanceIsSame() 
    {
        # Arrange:
        $rnd = new Random();
    
        # Act:
        $result = $rnd->equals($rnd);
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
    */
    public function Equals_ShouldBeFalseWhenInstanceIsNotSame() 
    {
        # Arrange:
        $r1 = new Random(1);
        $r2 = new Random(10);
    
        # Act:
        $result = $r1->equals($r2);
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Next_ThrowsExceptionWhenMinIsLessThanZero() 
    {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(-1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Next_ThrowsExceptionWhenMinIsLessThanZeroWithMaxValue() 
    {
        # Arrange:
        $rnd = new Random;
    
        # Act:
        $rnd->next(-1, 10);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Next_ThrowsExceptionWhenMinIsGreaterThanMaxValue() 
    {
        # Arrange:
        $rnd = new Random();

        # Act:
        $number = $rnd->next(2147483648);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Next_ThrowsExceptionWhenMinIsGreaterThanMax() 
    {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(10, 1);
    }

    /**
     * @test
    */
    public function Next_CanGenerateRandomNumber() 
    {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next();
        
        # Assert:
        $this->assertTrue($number > -1);
    }

    /**
     * @test
    */
    public function Next_CanGenerateRandomNumberWithSeed() 
    {
        # Arrange:
        $rnd = new Random(10);
               
        # Act:
        $number = $rnd->next();
        
        # Assert:
        $this->assertTrue($number >= 0 and $number <= 10);
    }

    /**
     * @test
    */
    public function Next_GenerateRandomShouldBeLessThanTen() 
    {
        # Arrange:
        $rnd = new Random();
        $max_number = 10;
        
        # Act:
        $number = $rnd->next($max_number);
        
        # Assert:
        $this->assertLessThanOrEqual($max_number, $number);
    }

    /**
     * @test
    */
    public function Next_CanGenerateNumberBetweenMinAndMax() 
    {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(5, 10);
        
        # Assert:
        $this->assertTrue($number >= 5 and $number <= 10);
    }

    

    /**
     * @test
    */
    public function NextDouble_CanGenerateRandomNumberBetweenZeroAndOne() 
    {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->nextDouble();

        # Assert:
        $this->assertTrue($number >= 0.0 and $number <= 1.0);
    }

    /**
     * @test
    */
    public function NextBytes_CanGenerateRandomNumbersToArray() 
    {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $bytes = $rnd->nextBytes();

        # Assert:
        for($i = 0; $i < sizeof($bytes); $i++) 
        {
            $byte = $bytes[$i];
            $this->assertTrue($byte >= 0 and $byte <= 255);
        }
    }

    /**
     * @test
    */
    public function ToString_ShouldRepresentRandomInString() 
    {
        # Arrange:
        $rnd = new Random;
    
        # Act:
        $str = $rnd->toString();
    
        # Assert:
        $this->assertNotNull($str);
    }

    /**
     * @test
    */
    public function ToString_ShouldRepresentRandomWithSeed() 
    {
        # Arrange:
        $rnd = new Random(10);
    
        # Act:
        $str = $rnd->toString();
    
        # Assert:
        $this->assertNotNull($str);
    }
}
