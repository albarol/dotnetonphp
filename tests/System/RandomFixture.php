<?php

//require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../system/Random.php';

class RandomTest extends PHPUnit_Framework_TestCase {

    public function testRandomNumber() {
        $rnd = new Random();
        $number = $rnd->next();
        $this->assertGreaterThanOrEqual(0, $number);
    }

    public function testRandomNumberWithSeed() {
        $rnd = new Random(10);
        $number = $rnd->next();
        $this->assertGreaterThanOrEqual(0, $number);
        $this->assertLessThanOrEqual(10, $number);
    }

    public function testMaxRandomNumber() {
        $rnd = new Random();
        $number = $rnd->next(10);
        $this->assertLessThanOrEqual(10, $number);
    }

    public function testCantGetMaxRandomNumberBecauseMaxValueIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $rnd = new Random();
        $number = $rnd->next(-1);
    }

    public function testCantGetMaxRandomNumberBecauseMaxValueGreaterThanInt32MaxValue() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $rnd = new Random();
        $number = $rnd->next(Int32::MaxValue+1);
    }

    public function testMinAndMaxRandomNumber() {
        $rnd = new Random();
        $number = $rnd->next(5, 10);
        $this->assertGreaterThanOrEqual(5, $number);
        $this->assertLessThanOrEqual(10, $number);
    }

    public function testCantGetMinAndMaxRandomNumberBecauseMinIsGreaterThanMax() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $rnd = new Random();
        $number = $rnd->next(10, 1);
    }

    public function testCanGetDoubleRandomNumber() {
        $rnd = new Random();
        $number = $rnd->nextDouble();
        $this->assertGreaterThanOrEqual(0.0, $number);
        $this->assertLessThanOrEqual(1.0, $number);
    }

    public function testCantGetBytesRandomNumbersBecauseBufferIsNull() {
        $this->setExpectedException("ArgumentNullException");
        $rnd = new Random();
        $rnd->nextBytes($result);
    }

    public function testCanGetBytesRandomNumbers() {
        $bytes = array(255, 1, 3, 255);
        $rnd = new Random();
        $rnd->nextBytes($bytes);

        for($i = 0; $i < sizeof($bytes); $i++) {
            $this->assertGreaterThanOrEqual(0, $bytes[$i]);
            $this->assertLessThanOrEqual(255, $bytes[$i]);
        }
    }
}
?>
