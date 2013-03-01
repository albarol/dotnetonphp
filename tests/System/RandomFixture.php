<?php

require_once dirname(__FILE__) . '/../../src/Autoloader.php';

use \System\Random as Random;

class RandomTest extends PHPUnit_Framework_TestCase {

    public function test_Next_CanGenerateRandomNumber() {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next();
        
        # Assert:
        $this->assertGreaterThanOrEqual(0, $number);
    }

    public function test_Next_CanGenerateRandomNumberWithSeed() {
        # Arrange:
        $rnd = new Random(10);
               
        # Act:
        $number = $rnd->next();
        
        # Assert:
        $this->assertGreaterThanOrEqual(0, $number);
        $this->assertLessThanOrEqual(10, $number);
    }


    public function test_Next_GenerateRandomShouldBeLessThanTen() {
        # Arrange:
        $rnd = new Random();
        $max_number = 10;
        
        # Act:
        $number = $rnd->next($max_number);
        
        # Assert:
        $this->assertLessThanOrEqual($max_number, $number);
    }

    public function test_Next_ThrowsExceptionWhenMinIsLessThanZero() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(-1);
    }

    public function test_Next_ThrowsExceptionWhenMinIsGreaterThanMaxValue() { 
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $rnd = new Random();

        # Act:
        $number = $rnd->next(2147483648);
    }

    public function test_Next_CanGenerateNumberBetweenMinAndMax() {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(5, 10);
        
        # Assert:
        $this->assertGreaterThanOrEqual(5, $number);
        $this->assertLessThanOrEqual(10, $number);
    }

    public function test_Next_ThrowsExceptionWhenMinIsGreaterThanMax() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $rnd = new Random();
        
        # Act:
        $number = $rnd->next(10, 1);
    }

    public function test_NextDouble_CanGenerateRandomNumberBetweenZeroAndOne() {
        # Arrange:
        $rnd = new Random();
        
        # Act:
        $number = $rnd->nextDouble();

        # Assert:
        $this->assertGreaterThanOrEqual(0.0, $number);
        $this->assertLessThanOrEqual(1.0, $number);
    }

    public function test_NextBytes_ThrowsExceptionWhenBufferIsNull() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentNullException");
        $rnd = new Random();

        # Act:
        $rnd->nextBytes($result);
    }

    public function test_NextBytes_CanGenerateRandomNumbersToArray() {
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
