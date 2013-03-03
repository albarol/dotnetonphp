<?php

namespace System { 


    use \System\Math as Math;
    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\FormatException as FormatException;
    use \System\IComparable as IComparable;
    use \System\IEquatable as IEquatable;

    /**
     * Represents a time interval.
     * @package System
     * @name TimeSpan
     * @access public
     */
    class TimeSpan implements IComparable, IEquatable {
        
        const TicksPerDay = 864000000000;
        const TicksPerHour = 36000000000;
        const TicksPerMinute = 600000000;
        const TicksPerSecond = 10000000;
        const TicksPerMillisecond = 10000;
        const MinValue = -92233720368548;
        const MaxValue = 92233720368548;

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
         * @param int $days Number of days.
         * @param int $hours Number of hours.
         * @param int $minutes Number of minutes.
         * @param int $seconds Number of seconds.
         * @param int $milliseconds Number of milliseconds.
         */
        public function __construct($days=0,$hours=0,$minutes=0,$seconds=0,$milliseconds=0) {
            if(!$this->containsValidNumbers(array($days,$hours,$minutes,$seconds,$milliseconds))) throw new ArgumentException("value is equal to System.Double.NaN.");
            $this->totalMilliseconds = $this->convertToMilliseconds($days,$hours,$minutes,$seconds,$milliseconds);
            $this->calculateTimeSpan($this->totalMilliseconds);
        }

        /**
         * Adds the specified System.TimeSpan to this instance.
         * @access public
         * @param TimeSpan $ts A System.TimeSpan.
         * @return TimeSpan A System.TimeSpan that represents the value of this instance plus the value of ts.
         */
        public function add(TimeSpan $ts) {
            $total_milliseconds = $this->totalMilliseconds + $ts->totalMilliseconds();
            $this->calculateTimeSpan($total_milliseconds);
            return $this;
        }

        public function compareTo($obj) {
            if(!$obj instanceof TimeSpan):
                throw new ArgumentException("value is not a System.TimeSpan.");
            endif;

            $this_value = $this->totalMilliseconds();
            $another_value = $obj->totalMilliseconds();

            if($this_value == $another_value):
                return 0;
            endif;

            return $this_value > $another_value ? 1 : -1; 
        }

        /**
         * Returns a new System.TimeSpan object whose value is the absolute value of the current System.TimeSpan object.
         * @access public
         * @return TimeSpan A new System.TimeSpan whose value is the absolute value of the current System.TimeSpan object.
         */
        public function duration() {
            if($this->totalMilliseconds == TimeSpan::MinValue) throw new OverFlowException("The value of this instance is System.TimeSpan.MinValue.");
            return clone $this;
        }

        
        /**
         * Returns a value indicating whether this instance is equal to a specified System.TimeSpan object.
         * @access public
         * @param object $other An object to compare with this instance.
         * @return bool true if obj represents the same time interval as this instance; otherwise, false.
         */
        public function equals($other) {
            if(!$other instanceof TimeSpan):
                return false;
            endif;

            return $this->totalMilliseconds() == 
                   $other->totalMilliseconds();
        }

        /**
         * Returns a System.TimeSpan that represents a specified number of days, where the specification is accurate to the nearest millisecond.
         * @access public
         * @param int $value value A number of days, accurate to the nearest millisecond.
         * @return TimeSpan A System.TimeSpan that represents value.
         */
        public static function fromDays($value) {
            return new TimeSpan($value, 0, 0, 0, 0);
        }

        /**
         * Returns a System.TimeSpan that represents a specified number of hours, where the specification is accurate to the nearest millisecond.
         * @access public
         * @param int $value A number of hours accurate to the nearest millisecond.
         * @return TimeSpan A System.TimeSpan that represents value.
         */
        public static function fromHours($value) {
            return new TimeSpan(0, $value, 0, 0, 0);
        }


         /**
          * Returns a System.TimeSpan that represents a specified number of milliseconds.
          * @access public
          * @param int $value A number of milliseconds.
          * @return A System.TimeSpan that represents value.
          */
        public static function fromMilliseconds($value) {
            return new TimeSpan(0, 0, 0, 0, $value);
        }

        /**
          * Returns a System.TimeSpan that represents a specified number of minutes, where the specification is accurate to the nearest millisecond.
          * @access public
          * @param int $value A number of minutes, accurate to the nearest millisecond.
          * @return TimeSpan A System.TimeSpan that represents value.
          */
        public static function fromMinutes($value) {
            return new TimeSpan(0, 0, $value, 0, 0);
        }

        /**
         * Returns a System.TimeSpan that represents a specified number of seconds, where the specification is accurate to the nearest millisecond.
         * @access public
         * @param int $value A number of seconds, accurate to the nearest millisecond.
         * @return TimeSpan A System.TimeSpan that represents value.
         */
        public static function fromSeconds($value) {
            return new TimeSpan(0, 0, 0, $value, 0);
        }

        /**
         * Returns a System.TimeSpan that represents a specified time, where the specification is in units of ticks.
         * @access public
         * @param int $value A number of ticks that represent a time.
         * @return TimeSpan A System.TimeSpan with a value of value.
         */
        public static function fromTicks($value) {
            return new TimeSpan(0, 0, 0, 0, ($value / TimeSpan::TicksPerMillisecond));
        }


        /**
         * Returns a System.TimeSpan whose value is the negated value of this instance.
         * @access public
         * @return TimeSpan The same numeric value as this instance, but with the opposite sign.
         */
        public function negate() {
            return new TimeSpan(0, 0, 0, 0, -1 * $this->totalMilliseconds);
        }

        /**
         * Constructs a new System.TimeSpan object from a time interval specified in a string.
         * @static
         * @access public
         * @param string $s A string that specifies a time interval.
         * @return TimeSpan A System.TimeSpan that corresponds to s.
         */
        public static function parse($s) {
            if(is_null($s)):
                throw new ArgumentNullException("s is null.");
            endif;

            $result = array();
            if(preg_match("/^([0-9]*).(2[0-3]|[0-1][0-9]):([0-5][0-9]):([0-5][0-9])$/", $s, $result))
                return new TimeSpan($result[1], $result[2], $result[3], $result[4]);
            if(preg_match("/^([0-9]*).(2[0-3]|[0-1][0-9]):([0-5][0-9]):([0-5][0-9]).([0-9]*)$/", $s, $result))
                return new TimeSpan($result[1], $result[2], $result[3], $result[4], $result[5]);
            if(preg_match("/^\d+$/", $s, $result))
                return new TimeSpan ($result[0], 0, 0, 0, 0);
            if(preg_match("/^(2[0-3]|[0-1][0-9]):([0-5][0-9])$/", $s, $result))
                return new TimeSpan(0, $result[1], $result[2]);
            if(preg_match("/^(2[0-3]|[0-1][0-9]):([0-5][0-9]):([0-5][0-9])$/", $s, $result))
                return new TimeSpan(0, $result[1], $result[2], $result[3]);

            throw new FormatException("s has an invalid format.");
        }

        /**
         * Subtracts the specified System.TimeSpan from this instance.
         * @access public
         * @param TimeSpan $ts A System.TimeSpan.
         * @return TimeSpan A System.TimeSpan whose value is the result of the value of this instance minus the value of ts.
         */
        public function subtract(TimeSpan $ts) {
            $milliseconds = $this->totalMilliseconds - $ts->totalMilliseconds();
            return new TimeSpan(0, 0, 0, 0, $milliseconds);
        }


        /**
         * Represents the maximum System.TimeSpan value. This field is read-only.
         * @static
         * @access public
         * @property-read
         * @return TimeSpan
         */
        public static function maxValue() {
            return new TimeSpan(0, 0, 0, 0, TimeSpan::MaxValue);
        }

        /**
         * Represents the minimum System.TimeSpan value. This field is read-only.
         * @static
         * @access public
         * @property-read
         * @return TimeSpan
         */
        public static function minValue() {
            return new TimeSpan(0, 0, 0, 0, TimeSpan::MinValue);
        }

        /**
         * Represents the zero System.TimeSpan value. This field is read-only.
         * @static
         * @access public
         * @property-read
         * @return TimeSpan
         */
        public static function zero() {
            return self::fromMilliseconds(0);
        }

        /**
         * Gets the number of whole days represented by the current System.TimeSpan structure.
         * @access public
         * @return float The day component of this instance. The return value can be positive or negative.
         */
        public function days() {
            return $this->days;
        }

        /**
         * Gets the number of whole hours represented by the current System.TimeSpan structure.
         * @access public
         * @return float The hour component of the current System.TimeSpan structure. The return value ranges from -23 through 23.
         */
        public function hours(){
            return $this->hours;
        }

        /**
         * Gets the number of whole milliseconds represented by the current System.TimeSpan structure.
         * @access public
         * @return float The millisecond component of the current System.TimeSpan structure. The return value ranges from -999 through 999.
         */
        public function milliseconds(){
            return $this->milliseconds;
        }

        /**
         * Gets the number of whole minutes represented by the current System.TimeSpan structure.
         * @access public
         * @return float The minute component of the current System.TimeSpan structure. The return value ranges from -59 through 59.
         */
        public function minutes() {
            return $this->minutes;
        }

        /**
         * Gets the number of whole seconds represented by the current System.TimeSpan structure.
         * @access public
         * @return float The second component of the current System.TimeSpan structure. The return value ranges from -59 through 59.
         */
        public function seconds() {
            return $this->seconds;
        }

        /**
         * Gets the number of ticks that represent the value of the current System.TimeSpan structure.
         * @access public
         * @return float The number of ticks contained in this instance.
         */
        public function ticks() {
            return $this->ticks;
        }


        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional days.
         * @access public
         * @return float The total number of days represented by this instance.
         */
        public function totalDays() {
            return $this->totalMilliseconds / $this->millisecondsInDays;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional hours.
         * @access public
         * @return float The total number of hours represented by this instance.
         */
        public function totalHours() {
            return $this->totalMilliseconds / $this->millisecondsInHours;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional milliseconds.
         * @access public
         * @return float The total number of milliseconds represented by this instance.
         */
        public function totalMilliseconds() {
            return $this->totalMilliseconds;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional minutes.
         * @access public
         * @return float The total number of minutes represented by this instance.
         */
        public function totalMinutes() {
            return $this->totalMilliseconds / $this->millisecondsInMinutes ;
        }

        /**
         * Gets the value of the current System.TimeSpan structure expressed in whole and fractional seconds.
         * @access public
         * @return float The total number of seconds represented by this instance.
         */
        public function totalSeconds() {
            return $this->totalMilliseconds / $this->millisecondsInSeconds;
        }


        /**
         * Constructs a new System.TimeSpan object from a time interval specified in a string. Parameters specify the time interval and the variable where the new System.TimeSpan object is returned.
         * @access public
         * @param string $s A string that specifies a time interval.
         * @return array true if s was converted successfully; otherwise, false. This operation returns false if the s parameter is null, has an invalid format, represents a time interval less than System.TimeSpan.MinValue or greater than System.TimeSpan.MaxValue, or has at least one days, hours, minutes, or seconds component outside its valid range. -and- TimeSpan $result When this method returns, contains an object that represents the time interval specified by s, or System.TimeSpan.Zero if the conversion failed. This parameter is passed uninitialized.
         */
        public static function tryParse($s) {
            try { 
                return array(
                    'result' => true,
                    'object' => TimeSpan::parse($s)
                );
            } catch(\Exception $e) {
                return array(
                    'result' => false,
                    'object' => null
                );
            }
        }

        /**
         * Validate if arguments is numeric
         * @access private
         * @param $numbers Array with arguments
         * @return  true if arguments is numeric, otherwise false
         */
        private function containsValidNumbers($numbers) {
            $result = true;
            for($i = 0; $i < sizeof($numbers) && $result; $i++) {
                if(!is_numeric($numbers[$i])):
                    $result = false;
                endif;
            }
            return $result;
        }

        /**
         * Convert all values in milliseconds
         * @throws OverflowException
         * @param int $days
         * @param int $hours
         * @param int $minutes
         * @param int $seconds
         * @param int $milliseconds
         * @return int
         */
        private function convertToMilliseconds($days=0,$hours=0,$minutes=0,$seconds=0,$milliseconds=0) {
            $time = 0;
            if(is_numeric($days)) $time = $days * $this->millisecondsInDays;
            if(is_numeric($hours)) $time += $hours * $this->millisecondsInHours;
            if(is_numeric($minutes)) $time += $minutes * $this->millisecondsInMinutes;
            if(is_numeric($seconds)) $time += $seconds * $this->millisecondsInSeconds;
            if(is_numeric($milliseconds)) $time += $milliseconds;

            if($time > TimeSpan::MaxValue || $time < TimeSpan::MinValue):
                throw new OverflowException("The return value is less than System.TimeSpan.MinValue or greater than System.TimeSpan.MaxValue");
            endif;

            return $time;
        }

        /**
         * Convert milliseconds to ticks
         * @param $totalMilliseconds
         * @return
         */
        private function convertToTicks($totalMilliseconds) {
            return $totalMilliseconds * TimeSpan::TicksPerMillisecond;
        }


        /**
         * Calculate value total of timespan
         * @access private
         * @param int $totalMilliseconds
         */
        private function calculateTimeSpan($totalMilliseconds) {
            $sign = ($totalMilliseconds == 0) ? 1 : $totalMilliseconds / Math::abs($totalMilliseconds);
            $totalMilliseconds = Math::abs($totalMilliseconds)*$sign;

            $this->totalMilliseconds = $totalMilliseconds;

            $this->days = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInDays);
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInDays);

            $this->hours = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInHours);
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInHours);

            $this->minutes = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInMinutes);
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInMinutes);

            $this->seconds = $this->getValueToProperty($totalMilliseconds, $this->millisecondsInSeconds);
            $totalMilliseconds = $this->removeTicksFromMilliseconds($totalMilliseconds, $this->millisecondsInSeconds);

            $this->milliseconds = $this->getValueToProperty($totalMilliseconds, 1);

            $this->ticks = $this->convertToTicks($this->totalMilliseconds);
        }

        private function getValueToProperty($totalMilliseconds, $ticks) {
            return Math::floor($totalMilliseconds / $ticks);
        }

        private function removeTicksFromMilliseconds($totalMilliseconds, $ticks) {
            return $totalMilliseconds % $ticks;
        }


    }
}