<?php

namespace System {

    use \System\Int32 as Int32;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\ArgumentNullException as ArgumentNullException;

    /**
     * Represents a pseudo-random number generator, a device that produces a sequence of numbers that meet certain statistical requirements for randomness.
     * @access public
     * @name Random
     * @package System
     */
    class Random {

        private $seed;

        public function __construct($seed=Int32::MaxValue) {
            $this->seed;
        }

        /**
         * Returns a nonnegative random number.
         * @access public
         * @param int $min The inclusive lower bound of the random number returned.
         * @param int $max The exclusive upper bound of the random number returned. maxValue must be greater than or equal to minValue.
         * @return int A 32-bit signed integer greater than or equal to minValue and less than maxValue; that is, the range of return values includes minValue but not maxValue. If minValue equals maxValue, minValue is returned.
         */
        public function next($min=0, $max=0) {
            if($min == 0 && $max == 0) {
                $this->validateNumber(0, $this->seed);
                return rand(0, $this->seed);
            }
            if($max == 0) {
                $this->validateNumber(0, $min);
                return rand(0, $min);
            }
            $this->validateNumber($min, $max);
            return rand($min, $max);
        }

        /**
         * Returns a random number between 0.0 and 1.0.
         * @access public
         * @return double A double-precision floating point number greater than or equal to 0.0, and less than 1.0.
         */
        public function nextDouble() {
            $number = $this->next(0, 10);
            return $number/10;
        }

        /**
         * Fills the elements of a specified array of bytes with random numbers.
         * @access public
         * @param $buffer An array of bytes to contain random numbers.
         */
        public function nextBytes(&$buffer) {
            if($buffer == null) throw new ArgumentNullException("buffer is null.");
            for($i = 0; $i < sizeof($buffer); $i++)
                $buffer[$i] = $this->next(0, 255);
        }

        private function validateNumber($min, $max) {
            if($max < 0) throw new ArgumentOutOfRangeException("maxValue is less than zero.");
            if($max > Int32::MaxValue) throw new ArgumentOutOfRangeException("max value is greater than System.Int32.MaxValue");
            if($min > $max) throw new ArgumentOutOfRangeException("minValue is greater than maxValue.");
        }
    }
}