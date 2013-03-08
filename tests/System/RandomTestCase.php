<?php

use \System\Random as Random;

/**
 * @group core
*/
class RandomTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function Next_CanGenerateRandomNumber() {
    
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next();
        
        # Assert:
        $this->assertGreaterThanOrEqual(0, $number);
    }

    /**
     * @test
    */
    public function Next_CanGenerateRandomNumberWithSeed() {
    
        # Arrange:
        $rnd = new Random(10);
               
        # Act:
        $number = $rnd->next();
        
        # Assert:
        $this->assertGreaterThanOrEqual(0, $number);
        $this->assertLessThanOrEqual(10, $number);
    }


    /**
     * @test
    */
    public function Next_GenerateRandomShouldBeLessThanTen() {
        
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
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Next_ThrowsExceptionWhenMinIsLessThanZero() {
        
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(-1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Next_ThrowsExceptionWhenMinIsGreaterThanMaxValue() { 
        
        # Arrange:
        $rnd = new Random();

        # Act:
        $number = $rnd->next(2147483648);
    }

    /**
     * @test
    */
    public function Next_CanGenerateNumberBetweenMinAndMax() {
        
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(5, 10);
        
        # Assert:
        $this->assertGreaterThanOrEqual(5, $number);
        $this->assertLessThanOrEqual(10, $number);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Next_ThrowsExceptionWhenMinIsGreaterThanMax() {
        
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(10, 1);
    }

    /**
     * @test
    */
    public function NextDouble_CanGenerateRandomNumberBetweenZeroAndOne() {
        
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->nextDouble();

        # Assert:
        $this->assertGreaterThanOrEqual(0.0, $number);
        $this->assertLessThanOrEqual(1.0, $number);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function NextBytes_ThrowsExceptionWhenBufferIsNull() {
        
        # Arrange:
        $rnd = new Random();

        # Act:
        $rnd->nextBytes($result);
    }

    /**
     * @test
    */
    public function NextBytes_CanGenerateRandomNumbersToArray() {
        # Arrange:
        $bytes = array(-1, -1, -1, -1);
        $rnd = new Random();
        
        # Act:
        $rnd->nextBytes($bytes);

        # Assert:
        for($i = 0; $i < sizeof($bytes); $i++) {
            $this->assertGreaterThanOrEqual(0, $bytes[$i]);
            $this->assertLessThanOrEqual(255, $bytes[$i]);
        }
    }
}
