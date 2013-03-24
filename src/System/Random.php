<?php

namespace System 
{

    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\OverflowException as OverflowException;

    /**
     * Represents a pseudo-random number generator, a device that produces a sequence of numbers that meet certain statistical requirements for randomness.
     *
     * @access public
     * @name Random
     * @package System
     */
    class Random 
    {
        private $seed;

        /**
         * Initializes a new instance of the Random class, using the specified seed value.
         *
         * @access public
         * @throws \System\OverflowException Seed is \System\Int32::MinValue, which causes an overflow when its absolute value is calculated.
         * @param int $seed A number used to calculate a starting value for the pseudo-random number sequence. If a negative number is specified, the absolute value of the number is used.
         * @return \System\Random Initializes a new instance of the Random class
        */
        public function __construct($seed=2147483647) 
        {
            if($seed <= -2147483647)
            {
                throw new OverflowException("Seed is \System\Int32::MinValue, which causes an overflow when its absolute value is calculated.");
            }

            $this->seed = $seed;
        }

        /**
         * Determines whether the specified Object is equal to the current Object.
         *
         * @access public
         * @param object $obj The Object to compare with the current Object.
         * @return bool true if the specified Object is equal to the current Object; otherwise, false.
        */
        public function equals($obj)
        {
            return $this == $obj;
        }

        /**
         * Gets the Type of the current instance.
         *
         * @access public
         * @return \System\Type The Type instance that represents the exact runtime type of the current instance.
        */
        public function getType()
        {

        }

        /**
         * Returns a nonnegative random number.
         *
         * @access public
         * @throws \System\ArgumentOutOfRangeException maxValue is less than zero. -or- max value is greater than MaxValue -or- min value is greater than max value.
         * @param int $min The inclusive lower bound of the random number returned.
         * @param int $max The exclusive upper bound of the random number returned. maxValue must be greater than or equal to minValue.
         * @return int A 32-bit signed integer greater than or equal to minValue and less than maxValue; that is, the range of return values includes minValue but not maxValue. If minValue equals maxValue, minValue is returned.
         */
        public function next($min = null, $max = null) 
        {
            if(is_null($min) && is_null($max))
            {
                $min = 0;
                $max = $this->seed;
            }
            elseif (is_null($max))
            {
                $max = $min;
                $min = 0;
            }

            if ($max < 0 || $min < 0)
            {
                throw new ArgumentOutOfRangeException("min value is less than zero -or- max value is less than zero.");
            }
                
            if ($max > 2147483647)
            {
                throw new ArgumentOutOfRangeException("max value is greater than MaxValue");
            }
                
            if($min > $max)
            {
                throw new ArgumentOutOfRangeException("min value is greater than max value.");
            }

            return rand($min, $max);
        }

        /**
         * Fills the elements of a specified array of bytes with random numbers.
         *
         * @access public
         * @return array An array of bytes to contain random numbers.
         */
        public function nextBytes()
        {
            $buffer = array();

            for($i = 0; $i < 10; $i++)
            {
                $buffer[$i] = $this->next(0, 255);
            }

            return $buffer;
        }

        /**
         * Returns a random number between 0.0 and 1.0.
         *
         * @access public
         * @return double A double-precision floating point number greater than or equal to 0.0, and less than 1.0.
         */
        public function nextDouble() 
        {
            $number = $this->next(0, 10);
            return $number/10;
        }

        /**
         * Returns a String that represents the current Object.
         *
         * @access public
         * @return string A String that represents the current Object.
        */
        public function toString()
        {
            $rnd = $this->next() * $this->nextDouble();
            return $rnd."";
        }
    }
}
