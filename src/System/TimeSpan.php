<?php

namespace System 
{ 
    use \System\OverflowException as OverflowException;
    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\FormatException as FormatException;
    use \System\IComparable as IComparable;
    use \System\IEquatable as IEquatable;

    /**
     * Represents a time interval.
     *
     * @package System
     * @name TimeSpan
     * @access public
     */
    class TimeSpan implements IComparable, IEquatable 
    {
        /**
         * Represents the number of ticks in 1 day. This field is constant.
         *
         * @access public
        */
        const TicksPerDay = 864000000000;
        
        /**
         * Represents the number of ticks in 1 hour. This field is constant.
         *
         * @access public
        */
        const TicksPerHour = 36000000000;

        /**
         * Represents the number of ticks in 1 minute. This field is constant.
         *
         * @access public
        */
        const TicksPerMinute = 600000000;

        /**
         * Represents the number of ticks in 1 second. This field is constant.
         *
         * @access public
        */
        const TicksPerSecond = 10000000;

        /**
         * Represents the number of ticks in 1 millisecond. This field is constant.
         *
         * @access public
        */
        const TicksPerMillisecond = 10000;
        
        /**
         * Represents the minimun TimeSpan value. This field is read-only.
         *
         * @access public
        */
        const MinValue = -92233720368548;

        /**
         * Represents the maximum TimeSpan value. This field is read-only.
         *
         * @access public
        */
        const MaxValue = 92233720368547;

        /**
         * Represents the zero TimeSpan value. This field is read-only.
         *
         * @access public
        */
        const Zero = 0;

        private $millisecondsInDays = 86400000;
        private $millisecondsInHours = 3600000;
        private $millisecondsInMinutes = 60000;
        private $millisecondsInSeconds = 1000;

        private $totalMilliseconds;
        private $days;
        private $hours;
        private $minutes;
        private $seconds;
        private $milliseconds;
        private $ticks;

        /**
         * Initializes a new System.TimeSpan to a specified number of days, hours, minutes, seconds, and milliseconds.
         * 
         * @throws \System\ArgumentException The parameters specify a TimeSpan value less than MinValue or greater than MaxValue.
         * @param int $days Number of days.
         * @param int $hours Number of hours.
         * @param int $minutes Number of minutes.
         * @param int $seconds Number of seconds.
         * @param int $milliseconds Number of milliseconds.
         */
        public function __construct($days = 0, $hours = 0, $minutes = 0, $seconds = 0, $milliseconds = 0) 
        {
            $milliseconds = $this->convertToMilliseconds($days, $hours, $minutes, $seconds, $milliseconds);
            
            if ($milliseconds > self::MaxValue || $milliseconds < self::MinValue)
            {
                throw new ArgumentException("The parameters specify a TimeSpan value less than MinValue or greater than MaxValue.");
            }

            $this->calculateTimeSpan($milliseconds);
        }

        /**
         * Adds the specified System.TimeSpan to this instance.
         *
         * @access public
         * @throws \System\OverflowException The resulting TimeSpan is less than MinValue or greater than MaxValue.
         * @param \System\TimeSpan $ts A System.TimeSpan.
         * @return \System\TimeSpan A System.TimeSpan that represents the value of this instance plus the value of ts.
         */
        public function add(TimeSpan $ts) 
        {
            $milliseconds = $this->totalMilliseconds + $ts->totalMilliseconds();
            if ($milliseconds > self::MaxValue || $milliseconds < self::MinValue)
            {
                throw new OverFlowException("The resulting TimeSpan is less than MinValue or greater than MaxValue.");
            }

            $this->calculateTimeSpan($milliseconds);
            return $this;
        }

        /**
         * Compares two TimeSpan values and returns an integer that indicates their relationship.
         *
         * @access public
         * @param \System\TimeSpan $t1 A TimeSpan.
         * @param \System\TimeSpan $t2 A TimeSpan.
         * @return int if t1 is less than t2 is -1 -or- if t1 is equal to t2 is 0 -or- if t1 is greater than t2 is 1.
        */
        public static function compare(TimeSpan $t1, TimeSpan $t2)
        {
            return $t1->compareTo($t2);
        }

        /**
         * Compares this instance to a specified object and returns an indication of their relative values.
         *
         * @access public
         * @throws \System\ArgumentException value is not a TimeSpan
         * @param object $value An object to compare, or a null reference
         * @return int -1 if the value of this instance is less than the value of value. -or- 0 if The value of this instance is equal to the value of value. -or- 1 The value of this instance is greater than the value of value.
        */
        public function compareTo($value) 
        {
            if (is_null($value))
            {
                return 1;
            }

            if(!$value instanceof TimeSpan)
            {
                throw new ArgumentException("value is not a TimeSpan.");
            }

            $t1 = $this->totalMilliseconds();
            $t2 = $value->totalMilliseconds();

            if($t1 == $t2)
            {
                return 0;
            }

            return $t1 > $t2 ? 1 : -1; 
        }

        /**
         * Gets the number of whole days represented by the current System.TimeSpan structure.
         *
         * @access public
         * @return int The day component of this instance. The return value can be positive or negative.
         */
        public function days() 
        {
            return round($this->days, 0);
        }

        /**
         * Returns a new Timespan object whose value is the absolute value of the current Timespan object.
         *
         * @access public
         * @return \System\TimeSpan A new System.TimeSpan whose value is the absolute value of the current System.TimeSpan object.
         */
        public function duration() 
        {
            if($this->totalMilliseconds == TimeSpan::MinValue) 
            {
                throw new OverFlowException("The value of this instance is System.TimeSpan.MinValue.");
            }
            
            return Timespan::fromMilliseconds(abs($this->totalMilliseconds));
        }

        
        /**
         * Returns a value indicating whether this instance is equal to a specified System.TimeSpan object.
         *
         * @access public
         * @param object $other An object to compare with this instance.
         * @return bool true if obj represents the same time interval as this instance; otherwise, false.
         */
        public function equals($other) 
        {
            return $this == $other;
        }

        /**
         * Returns a TimeSpan that represents a specified number of days, where the specification is accurate to the nearest millisecond.
         *
         * @access public
         * @throws \System\OverflowException value is less than MinValue or greater than MaxValue.
         * @throws \System\ArgumentException valus is equal to NaN
         * @param int $value value A number of days, accurate to the nearest millisecond.
         * @return \System\TimeSpan A System.TimeSpan that represents value.
         */
        public static function fromDays($value) 
        {
            if(is_nan($value))
            {
                throw new OverflowException("value is equal to NaN");
            }

            return new TimeSpan($value, 0, 0, 0, 0);
        }

        /**
         * Returns a TimeSpan that represents a specified number of hours, where the specification is accurate to the nearest millisecond.
         *
         * @access public
         * @throws \System\OverflowException value is less than MinValue or greater than MaxValue.
         * @throws \System\ArgumentException valus is equal to NaN
         * @param int $value A number of hours accurate to the nearest millisecond.
         * @return \System\TimeSpan A System.TimeSpan that represents value.
         */
        public static function fromHours($value) 
        {
            if(is_nan($value))
            {
                throw new OverflowException("value is equal to NaN");
            }

            return new TimeSpan(0, $value, 0, 0, 0);
        }


         /**
          * Returns a TimeSpan that represents a specified number of milliseconds.
          *
          * @access public
          * @throws \System\OverflowException value is less than MinValue or greater than MaxValue.
          * @throws \System\ArgumentException valus is equal to NaN
          * @param int $value A number of milliseconds.
          * @return \System\Timespan A TimeSpan that represents value.
          */
        public static function fromMilliseconds($value) 
        {
            if(is_nan($value))
            {
                throw new OverflowException("value is equal to NaN");
            }

            return new TimeSpan(0, 0, 0, 0, $value);
        }

        /**
          * Returns a TimeSpan that represents a specified number of minutes, where the specification is accurate to the nearest millisecond.
          *
          * @access public
          * @throws \System\OverflowException value is less than MinValue or greater than MaxValue.
          * @throws \System\ArgumentException valus is equal to NaN
          * @param int $value A number of minutes, accurate to the nearest millisecond.
          * @return \System\TimeSpan A TimeSpan that represents value.
          */
        public static function fromMinutes($value) 
        {
            if(is_nan($value))
            {
                throw new OverflowException("value is equal to NaN");
            }

            return new TimeSpan(0, 0, $value, 0, 0);
        }

        /**
         * Returns a TimeSpan that represents a specified number of seconds, where the specification is accurate to the nearest millisecond.
         *
         * @access public
         * @throws \System\OverflowException value is less than MinValue or greater than MaxValue.
         * @throws \System\ArgumentException valus is equal to NaN
         * @param int $value A number of seconds, accurate to the nearest millisecond.
         * @return \System\TimeSpan A TimeSpan that represents value.
         */
        public static function fromSeconds($value) 
        {
            if(is_nan($value))
            {
                throw new OverflowException("value is equal to NaN");
            }

            return new TimeSpan(0, 0, 0, $value, 0);
        }

        /**
         * Returns a TimeSpan that represents a specified time, where the specification is in units of ticks.
         *
         * @access public
         * @throws \System\OverflowException value is less than MinValue or greater than MaxValue.
         * @throws \System\ArgumentException valus is equal to NaN
         * @param int $value A number of ticks that represent a time.
         * @return \System\TimeSpan A TimeSpan with a value of value.
         */
        public static function fromTicks($value) 
        {
            if(is_nan($value))
            {
                throw new OverflowException("value is equal to NaN");
            }

            return new TimeSpan(0, 0, 0, 0, ($value / TimeSpan::TicksPerMillisecond));
        }


        public function getType()
        {

        }

        /**
         * Gets the number of whole hours represented by the current System.TimeSpan structure.
         * @access public
         * @return float The hour component of the current System.TimeSpan structure. The return value ranges from -23 through 23.
         */
        public function hours()
        {
            return $this->hours;
        }

        /**
         * Gets the number of whole milliseconds represented by the current System.TimeSpan structure.
         * @access public
         * @return float The millisecond component of the current System.TimeSpan structure. The return value ranges from -999 through 999.
         */
        public function milliseconds()
        {
            return $this->milliseconds;
        }

        /**
         * Gets the number of whole minutes represented by the current System.TimeSpan structure.
         * @access public
         * @return float The minute component of the current System.TimeSpan structure. The return value ranges from -59 through 59.
         */
        public function minutes() 
        {
            return $this->minutes;
        }


        /**
         * Returns a System.TimeSpan whose value is the negated value of this instance.
         *
         * @access public
         * @throws \System\OverflowException The negated value of this instance cannot be represented by a TimeSpan; that is, the value of this instance is MinValue.
         * @return \System\TimeSpan The same numeric value as this instance, but with the opposite sign.
         */
        public function negate() 
        {
            $value = -1*$this->totalMilliseconds;

            if($value > self::MaxValue)
            {
                throw new OverflowException("The negated value of this instance cannot be represented by a TimeSpan; that is, the value of this instance is MinValue.");
            }

            return new TimeSpan(0, 0, 0, 0, $value);
        }

        /**
         * Constructs a new System.TimeSpan object from a time interval specified in a string.
         *
         * @static
         * @access public
         * @throws \System\ArgumentNullException s is null.
         * @throws \System\FormatException s has an invalid format.
         * @throws \System\OverflowException s represents a number less than MinValue or greater than MaxValue.
         * @param string $s A string that specifies a time interval.
         * @return \System\TimeSpan A System.TimeSpan that corresponds to s.
         */
        public static function parse($s) 
        {
            if(is_null($s))
            {
                throw new ArgumentNullException("s is null.");
            }

            $matches = array(
                'D.H:m:s'   => "/^([0-9]*).(2[0-3]|[0-1][0-9]):([0-5][0-9]):([0-5][0-9])$/",
                'D.H:m:s.t' => "/^([0-9]*).(2[0-3]|[0-1][0-9]):([0-5][0-9]):([0-5][0-9]).([0-9]*)$/",
                'D'         => "/^\d+$/",
                'H:m'       => "/^(2[0-3]|[0-1][0-9]):([0-5][0-9])$/",
                'H:m:s'     => "/^(2[0-3]|[0-1][0-9]):([0-5][0-9]):([0-5][0-9])$/" 
            );
            $result = array();
            if(preg_match($matches['D.H:m:s'], $s, $result))
                return new TimeSpan($result[1], $result[2], $result[3], $result[4]);
            if(preg_match($matches['D.H:m:s.t'], $s, $result))
                return new TimeSpan($result[1], $result[2], $result[3], $result[4], $result[5]);
            if(preg_match($matches['D'], $s, $result))
                return new TimeSpan ($result[0], 0, 0, 0, 0);
            if(preg_match($matches['H:m'], $s, $result))
                return new TimeSpan(0, $result[1], $result[2]);
            if(preg_match($matches['H:m:s'], $s, $result))
                return new TimeSpan(0, $result[1], $result[2], $result[3]);

            throw new FormatException("s has an invalid format.");
        }

        /**
         * Gets the number of whole seconds represented by the current System.TimeSpan structure.
         *
         * @access public
         * @return float The second component of the current System.TimeSpan structure. The return value ranges from -59 through 59.
         */
        public function seconds() 
        {
            return $this->seconds;
        }

        /**
         * Subtracts the specified System.TimeSpan from this instance.
         *
         * @access public
         * @throws \System\OverflowException The return value is less than MinValue or greater than MaxValue.
         * @param \System\TimeSpan $ts A System.TimeSpan.
         * @return \System\TimeSpan A System.TimeSpan whose value is the result of the value of this instance minus the value of ts.
         */
        public function subtract(TimeSpan $ts) 
        {
            $milliseconds = $this->totalMilliseconds - $ts->totalMilliseconds();

            if($milliseconds < self::MinValue or $milliseconds > self::MaxValue)
            {
                throw new OverflowException("The return value is less than MinValue or greater than MaxValue.");
            }

            return new TimeSpan(0, 0, 0, 0, $milliseconds);
        }

        /**
         * Gets the number of ticks that represent the value of the current System.TimeSpan structure.
         *
         * @access public
         * @return float The number of ticks contained in this instance.
         */
        public function ticks() 
        {
            return $this->ticks;
        }

        /**
         * Returns the string representation of the value of this instance.
         * 
         * @access public
         * @return string 
        */
        public function toString()
        {
            $sign = ($this->totalMilliseconds == 0) ? 1 : $this->totalMilliseconds / abs($this->totalMilliseconds);
            $str_sign = ($sign == -1) ? '-' : '';
            return $str_sign .
                   abs($this->days) . "." .
                   str_pad(abs($this->hours), 2, '0', STR_PAD_LEFT) . ":" .
                   str_pad(abs($this->minutes), 2, '0', STR_PAD_LEFT) . ":" . 
                   str_pad(abs($this->seconds), 2, '0', STR_PAD_LEFT) . "." . 
                   str_pad(abs($this->milliseconds), 7, '0', STR_PAD_RIGHT);
        }

        /**
         * Returns the string representation of the value of this instance.
         * 
         * @access public
         * @return string 
        */
        public function __toString()
        {
            return $this->toString();
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional days.
         *
         * @access public
         * @return float The total number of days represented by this instance.
         */
        public function totalDays() 
        {
            return $this->totalMilliseconds / $this->millisecondsInDays;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional hours.
         *
         * @access public
         * @return float The total number of hours represented by this instance.
         */
        public function totalHours() 
        {
            return $this->totalMilliseconds / $this->millisecondsInHours;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional milliseconds.
         *
         * @access public
         * @return float The total number of milliseconds represented by this instance.
         */
        public function totalMilliseconds() 
        {
            return $this->totalMilliseconds;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional minutes.
         *
         * @access public
         * @return float The total number of minutes represented by this instance.
         */
        public function totalMinutes() {
            return $this->totalMilliseconds / $this->millisecondsInMinutes ;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional seconds.
         *
         * @access public
         * @return float The total number of seconds represented by this instance.
         */
        public function totalSeconds() 
        {
            return $this->totalMilliseconds / $this->millisecondsInSeconds;
        }


        /**
         * Constructs a new System.TimeSpan object from a time interval specified in a string. Parameters specify the time interval and the variable where the new System.TimeSpan object is returned.
         *
         * @access public
         * @param string $s A string that specifies a time interval.
         * @return array true if s was converted successfully; otherwise, false. This operation returns false if the s parameter is null, has an invalid format, represents a time interval less than System.TimeSpan.MinValue or greater than System.TimeSpan.MaxValue, or has at least one days, hours, minutes, or seconds component outside its valid range. -and- TimeSpan $result When this method returns, contains an object that represents the time interval specified by s, or System.TimeSpan.Zero if the conversion failed. This parameter is passed uninitialized.
         */
        public static function tryParse($s) 
        {
            try 
            { 
                return array(
                    'result' => true,
                    'object' => TimeSpan::parse($s)
                );
            } 
            catch(\Exception $e) 
            {
                return array(
                    'result' => false,
                    'object' => null
                );
            }
        }

        /**
         * Convert all values in milliseconds
         * @throws \System\ArgumentException
         * @param int $days
         * @param int $hours
         * @param int $minutes
         * @param int $seconds
         * @param int $milliseconds
         * @return int
         */
        private function convertToMilliseconds($days=0,$hours=0,$minutes=0,$seconds=0,$milliseconds=0) {
            $time = 0;
            
            if(is_numeric($days)) 
            {
                $time = $days * $this->millisecondsInDays;
            }
            
            if(is_numeric($hours)) 
            {
                $time += $hours * $this->millisecondsInHours;
            }
            
            if(is_numeric($minutes))
            {
                $time += $minutes * $this->millisecondsInMinutes;
            }
            
            if(is_numeric($seconds))
            {
                $time += $seconds * $this->millisecondsInSeconds;
            }
            
            if(is_numeric($milliseconds)) 
            {
                $time += $milliseconds;
            }
            
            return $time;
        }

        /**
         * Calculate value total of timespan
         * @access private
         * @param int $totalMilliseconds
         */
        private function calculateTimeSpan($totalMilliseconds) 
        {
            $sign = ($totalMilliseconds == 0) ? 1 : $totalMilliseconds / abs($totalMilliseconds);
            $this->totalMilliseconds = $totalMilliseconds;
            $totalMilliseconds = abs($totalMilliseconds);

            $this->days = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInDays) * $sign;
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInDays);

            $this->hours = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInHours) * $sign;
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInHours);

            $this->minutes = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInMinutes) * $sign;
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInMinutes);

            $this->seconds = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInSeconds) * $sign;
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInSeconds);

            $this->milliseconds = $this->getValueToProperty($totalMilliseconds, 1) * $sign;

            $this->ticks = $this->totalMilliseconds * TimeSpan::TicksPerMillisecond *$sign;
        }

        private function getValueToProperty($totalMilliseconds, $ticks) 
        {
            return Math::floor($totalMilliseconds / $ticks);
        }

        private function removeTicksFromMilliseconds($totalMilliseconds, $ticks) 
        {
            return $totalMilliseconds % $ticks;
        }
   }
}