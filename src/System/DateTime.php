<?php

namespace System {


    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\DayOfWeek as DayOfWeek;
    use \System\DateTimeKind as DateTimeKind;
    use \System\TimeSpan as TimeSpan;
    use \System\TypeCode as TypeCode;

    /**
     * Represents an instant in time, typically expressed as a date and time of day.
     * @access public
     * @package System
     * @name DateTime
     */
    final class DateTime {

        private $year;
        private $month;
        private $day;
        private $hours;
        private $minutes;
        private $seconds;
        protected $kind;

        /**
         * Initializes a new instance of the DateTime structure.
         * @access public
         * @param int $year
         * @param int $month
         * @param int $day
         * @param int $hours
         * @param int $minutes
         * @param int $seconds
         */
        public function  __construct($year, $month, $day, $hours = 0, $minutes = 0, $seconds = 0) {
            if (!checkdate($month, $day, $year) || !$this->isValidYear($year)):
                throw new ArgumentOutOfRangeException("year is less than 1 or greater than 9999. -or-  month is less than 1 or greater than 12. -or-  day is less than 1 or greater than the number of days in month.");
            endif;

            $this->year = $year;
            $this->month = $month;
            $this->day = $day;
            $this->hours = $hours;
            $this->minutes = $minutes;
            $this->seconds = $seconds;
            $this->kind = DateTimeKind::unespecified();
        }


        /*
         * TODO: System.DateTime.FromBinary(long);
         * TODO: System.DateTime.FromBinary(long);
         * TODO: System.DateTime.FromFileTime(long);
         * TODO: System.DateTime.ToBinary()
         * TODO: System.DateTime.ToFileTime()
         * TODO: System.DateTime.ToFileTimeUtc()
         * TODO: System.DateTime.ToFileTimeUtc()
         * TODO: System.DateTime.ToUniversalTime()
         * TODO: Ticks
         */

        /**
         * Adds the value of the specified System.TimeSpan to the value of this instance.
         * @access public
         * @param TimeSpan $value A System.TimeSpan object that represents a positive or negative time interval.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and the time interval represented by value.
         */
        public function add(TimeSpan $value) {
            $time = clone $this;
            $time->addDays($value->days());
            $time->addHours($value->hours());
            $time->addMinutes($value->minutes());
            $time->addSeconds($value->seconds());
            return $time;
        }


        /**
         * Adds the specified number of days to the value of this instance.
         * @access public
         * @param float $value A number of whole and fractional days. The value parameter can be negative or positive.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and the number of days represented by value.
         */
        public function addDays($value) {
            $this->calculateDate($value, $this->day);
            return $this;
        }

        /**
         * Adds the specified number of hours to the value of this instance.
         * @access public
         * @param float $value A number of whole and fractional hours. The value parameter can be negative or positive.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and the number of hours represented by value.
         */
        public function addHours($value) {
            $this->calculateDate($value, $this->hours);
            return $this;
        }


        /**
         * Adds the specified number of minutes to the value of this instance.
         * @access public
         * @param float $value A number of whole and fractional minutes. The value parameter can be negative or positive.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and the number of minutes represented by value.
         */
        public function addMinutes($value) {
            $this->calculateDate($value, $this->minutes);
            return $this;
        }


        /**
         * Adds the specified number of months to the value of this instance.
         * @access public
         * @param float $value A number of months. The months parameter can be negative or positive.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and months.
         */
        public function addMonths($value) {
            $this->calculateDate($value, $this->month);
            return $this;
        }

        /**
         * Adds the specified number of seconds to the value of this instance.
         * @access public
         * @param float $value A number of whole and fractional seconds. The value parameter can be negative or positive.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and the number of seconds represented by value.
         */
        public function addSeconds($value) {
            $this->calculateDate($value, $this->seconds);
            return $this;
        }

        /**
         * Adds the specified number of years to the value of this instance.
         * @access public
         * @param float $value A number of years. The value parameter can be negative or positive.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and the number of years represented by value.
         */
        public function addYears($value) {
            $this->calculateDate($value, $this->year);
            return $this;
        }

        /**
         * Compares two instances of System.DateTime and returns an integer that indicates whether the first instance is earlier than, the same as, or later than the second instance.
         * @access public
         * @static
         * @param DateTime $t1 The first System.DateTime.
         * @param DateTime $t2 The second System.DateTime.
         * @return Boolean A signed number indicating the relative values of t1 and t2. Less than zero t1 is earlier than t2. Zero t1 is the same as t2. Greater than zero t1 is later than t2.
         */
        public static function compare(DateTime $t1, DateTime $t2) {
            return $t1->compareTo($t2);
        }

        /**
         * Compares the value of this instance to a specified object that contains a specified System.DateTime value, and returns an integer that indicates whether this instance is earlier than, the same as, or later than the specified System.DateTime value.
         * @access public
         * @param object $value A boxed System.DateTime object to compare, or null.
         * @return Boolean A signed number indicating the relative values of t1 and t2. Less than zero This instance is earlier than value. Zero This instance is the same as value. Greater than zero  This instance is later than value, or value is null.
         */
        public function compareTo($value) {
            if (!($value instanceOf DateTime)):
                return 1;
            endif;

            $first = strtotime($this->toString());
            $second = strtotime($value->toString());
            
            if($first == $second):
                return 0;
            endif;

            return $first > $second ? 1 : -1;
        }

        /**
         * Gets the date component of this instance.
         * @access public
         * @return DateTime A new System.DateTime with the same date as this instance, and the time value set to 12:00:00 midnight (00:00:00).
         */
        public function date() {
            return new DateTime($this->year(), $this->month(), $this->day());
        }


        /**
         * Gets the day of the month represented by this instance.
         * @access public
         * @return int The day component, expressed as a value between 1 and 31.
         */
        public function day() {
            return $this->day;
        }

        /**
         * Gets the day of the week represented by this instance.
         * @access public
         * @return DayOfWeek A System.DayOfWeek enumerated constant that indicates the day of the week of this System.DateTime value.
         */
        public function dayOfWeek() {
            $dayOfWeek = $this->toString('w');
            switch ($dayOfWeek) {
                case 0:
                    return DayOfWeek::sunday();
                case 1:
                    return DayOfWeek::monday();
                case 2:
                    return DayOfWeek::tuesday();
                case 3:
                    return DayOfWeek::wednesday();
                case 4:
                    return DayOfWeek::thursday();
                case 5:
                    return DayOfWeek::friday();
                default:
                    return DayOfWeek::saturday();
            }
        }

        /**
         * Gets the day of the week represented by this instance.
         * @access public
         * @return int The day of the year, expressed as a value between 1 and 366.
         */
        public function dayOfYear() {
            return $this->toString('z') + 1;
        }


        /**
         * Returns the number of days in the specified month and year.
         * @access public
         * @static
         * @param int $year The year.
         * @param int $month The month (a number ranging from 1 to 12).
         * @return int The number of days in month for the specified year.
         */
        public static function daysInMonth($year, $month) {
            $date = new DateTime($year, $month, 1);
            return $date->toString("t");
        }


        /**
         * Converts the value of this instance to all the string representations supported by the standard System.DateTime format specifiers.
         * @access public
         * @return array A string array where each element is the representation of the value of this instance formatted with one of the standard System.DateTime formatting specifiers.
         */
        public function getDateAndTimeFormats() {
            $formats = array();
            array_push($formats, $this->toString("Y-n-j"));
            array_push($formats, $this->toString("y-n-j"));
            array_push($formats, $this->toString("Y-m-d"));
            array_push($formats, $this->toString("y-m-d"));
            array_push($formats, $this->toString("Y.n.j"));
            array_push($formats, $this->toString("y.n.j"));
            array_push($formats, $this->toString("Y.m.d"));
            array_push($formats, $this->toString("y.m.d"));
            array_push($formats, $this->toString("l, j F Y"));
            array_push($formats, $this->toString("j F Y"));
            array_push($formats, $this->toString("Y-n-j H:i"));
            array_push($formats, $this->toString("y-n-j H:i"));
            array_push($formats, $this->toString("Y-m-d H:i"));
            array_push($formats, $this->toString("y-m-d H:i"));
            array_push($formats, $this->toString("d F"));
            array_push($formats, $this->toString("r"));
            array_push($formats, $this->toString("H:i"));
            array_push($formats, $this->toString("h:i A"));
            array_push($formats, $this->toString("H:i:s"));
            array_push($formats, $this->toString("h:i:s A"));
            array_push($formats, gmdate("Y-m-d H:i", mktime($this->hours, $this->minutes, $this->seconds, $this->month, $this->day, $this->year)) . " GMT");
            return $formats;
        }

        /**
         * Gets the hour component of the date represented by this instance.
         * @access public
         * @return int The hour component, expressed as a value between 0 and 23.
         */
        public function hours() {
            return $this->hours;
        }


        /**
         * Indicates whether this instance of System.DateTime is within the Daylight Saving Time range for the current time zone.
         * @access public
         * @return bool true if System.DateTime.Kind is System.DateTimeKind.Local or System.DateTimeKind.Unspecified and the value of this instance of System.DateTime is within the Daylight Saving Time range for the current time zone. false if System.DateTime.Kind is System.DateTimeKind.Utc.
         */
        public function isDaylightSavingTime() {
            return ($this->toString("I") == 1 ? true : false);
        }

        /**
         * Returns an indication whether the specified year is a leap year.
         * @access public
         * @static
         * @param int $year A 4-digit year.
         * @return bool true if year is a leap year; otherwise, false.
         */
        public static function isLeapYear($year) {
            $isLeap = date("L", mktime(0, 0, 0, 1, 1, $year));
            return ($isLeap == 1) ? true : false;
        }

        /**
         * Gets a value that indicates whether the time represented by this instance is based on local time, Coordinated Universal Time (UTC), or neither.
         * @access public
         * @return \System\DateTimeKind One of the DateTimeKind values. The default is Unspecified.
         */
        public function kind() {
            return $this->kind;
        }


        /**
         * Gets the minute component of the date represented by this instance.
         * @access public
         * @return int The minute component, expressed as a value between 0 and 59.
         */
        public function minutes() {
            return $this->minutes;
        }

        /**
         * Gets the month component of the date represented by this instance.
         * @access public
         * @return int The month component, expressed as a value between 1 and 12.
         */
        public function month() {
            return $this->month;
        }

        /**
         * Gets a System.DateTime object that is set to the current date and time on this computer, expressed as the local time.
         * @access public
         * @return DateTime A System.DateTime whose value is the current local date and time.
         */
        public static function now() {
            $date = getdate();
            return new DateTime($date["year"], $date["mon"], $date["mday"], $date["hours"], $date["minutes"], $date["seconds"]);
        }


        /**
         * Converts the specified string representation of a date and time to its DateTime equivalent.
         * @access public
         * @static
         * @throws ArgumentNullException|FormatException
         * @param string $s A string containing a date and time to convert.
         * @return DateTime An object that is equivalent to the date and time contained in s.
         */
        public static function parse($s) {
            if ($s == null):
                throw new ArgumentNullException("s is null.");
            endif;
            
            $dateTime = date_parse(str_replace(".", "-", $s));
            if ($dateTime["error_count"] > 1):
                throw new FormatException("Format is invalid.");
            endif;

            return new DateTime($dateTime["year"], $dateTime["month"], $dateTime["day"], $dateTime["hour"], $dateTime["minute"], $dateTime["second"]);
        }

        /**
        * Gets the seconds component of the date represented by this instance.
        * @access public
        * @return int The seconds, between 0 and 59.
        */
        public function seconds() {
            return $this->seconds;
        }

        /**
         * Creates a new DateTime object that represents the same time as the specified DateTime, but is designated in either local time, Coordinated Universal Time (UTC), or neither, as indicated by the specified DateTimeKind value.
         * @static
         * @param DateTime $value
         * @param \System\DateTimeKind $kind
         * @return \System\DateTime A new DateTime object consisting of the same time represented by the value parameter and the DateTimeKind value specified by the kind parameter.
         */
        public static function specifyKind(DateTime $value, DateTimeKind $kind) {
            $value->kind = $kind;
            if ($kind == DateTimeKind::utc()):
                return $value->utcNow();
            else:
                return $value;
            endif;
        }


        /**
         * Subtracts the specified date and time from this instance.
         * @access public
         * @param DateTime $value An instance of System.DateTime. -or- An instance of System.TimeSpan
         * @return TimeSpan A System.TimeSpan interval equal to the date and time represented by this instance minus the date and time represented by value.
         */
        public function subtract($value) {
            if ($value instanceof DateTime):
                return $this->subtractDate($value);
            elseif ($value instanceof TimeSpan):
                return $this->subtractTimeSpan($value);
            else:
                return null;
            endif;
        }

        private function subtractDate($value) {
            $year = $this->year() - $value->year();
            $month = $this->month() - $value->month();
            $day = $this->day() - $value->day();
            $hours = $this->hours() - $value->hours();
            $minutes = $this->minutes() - $value->minutes();
            $seconds = $this->seconds() - $value->seconds();
            $day = $day + ($month * 30.5) + ($year * 365.25);
            return new TimeSpan($day, $hours, $minutes, $seconds);
        }

        private function subtractTimeSpan($value) {
            $day = $this->day() - $value->days();
            $hours = $this->hours() - $value->hours();
            $minutes = $this->minutes() - $value->minutes();
            $seconds = $this->seconds() - $value->seconds();
            return new TimeSpan($day, $hours, $minutes, $seconds);
        }

        /**
         * Gets the current date.
         * @access public
         * @static
         * @return DateTime A System.DateTime set to today's date, with the time component set to 00:00:00.
         */
        public static function today() {
            $now = self::now();
            return $now->date();
        }


        /**
         * Converts the specified string representation of a date and time to its DateTime equivalent.
         * @access public
         * @static
         * @param string $s A string containing a date and time to convert.
         * @param \System\DateTime $result When this method returns, contains the DateTime value equivalent to the date and time contained in s, if the conversion succeeded, or MinValue if the conversion failed. The conversion fails if the s parameter is a null reference, or does not contain a valid string representation of a date and time. This parameter is passed uninitialized.
         * @return bool
         */
        public static function tryParse($s, &$result) {
            try {
                $result = self::parse($s);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }


        /**
         * Converts the value of the current DateTime object to local time.
         * @access public
         * @return \System\DateTime A DateTime object whose Kind property is Local, and whose value is the local time equivalent to the value of the current DateTime object, or MaxValue if the converted value is too large to be represented by a DateTime object, or MinValue if the converted value is too small to be represented as a DateTime object.
         */
        public function toLocalTime() {
            throw new \Exception();
        }


        /**
         * Converts the value of this instance to its equivalent long date string representation. 
         * @return string A string containing the name of the day of the week, the name of the month, the numeric day of the month, and the year equivalent to the date value of this instance. 
         */
        public function toLongDateString() {
            return $this->toString("l, M d, Y");
        }


        /**
         * Converts the value of this instance to its equivalent long time string representation. 
         * @return string A string containing the name of the day of the week, the name of the month, the numeric day of the hours, minutes, and seconds equivalent to the time value of this instance. 
         */
        public function toLongTimeString() {
            return $this->toString("h:i:s A");
        }


        /**
         * Converts the value of this instance to the equivalent OLE Automation date.
         * @access public
         * @return string A double-precision floating-point number that contains an OLE Automation date equivalent to the value of this instance. 
         */
        public function toOADate() {
            throw new \Exception();
        }

        /**
         * Converts the value of this instance to its equivalent short date string representation.
         * @access public
         * @return string A string containing the numeric month, the numeric day of the month, and the year equivalent to the date value of this instance.
         */
        public function toShortDateString() {
            return $this->toString("Y-m-d");
        }

        /**
         * Converts the value of this instance to its equivalent short time string representation.
         * @access public
         * @return string A string containing the name of the day of the week, the name of the month, the numeric day of the hours, minutes, and seconds equivalent to the time value of this instance.
         */
        public function toShortTimeString() {
            return $this->toString("H:m");
        }


        /**
         * Converts the value of the current DateTime object to Coordinated Universal Time (UTC).
         * @access public
         * @return \System\DateTime A DateTime object whose Kind property is Utc, and whose value is the UTC equivalent to the value of the current DateTime object, or MaxValue if the converted value is too large to be represented by a DateTime object, or MinValue if the converted value is too small to be represented by a DateTime object.
         */
        public function toUniversalTime() {
            return $this->utcNow();
        }


        /**
         * Converts the value of the current System.DateTime object to its equivalent string representation.
         * @access public
         * @param string $format A format string.
         * @return string A string representation of value of this instance as specified by format.
         */
        public function toString($format = "") {
            if (strlen($format) > 0) return date($format, mktime($this->hours, $this->minutes, $this->seconds, $this->month, $this->day, $this->year));
            return $this->year . "-" . $this->month . "-" . $this->day . " " . $this->hours . ":" . $this->minutes . ":" . $this->seconds;
        }

        /**
         * Gets a DateTime object that is set to the current date and time on this computer, expressed as the Coordinated Universal Time (UTC).
         * @access public
         * @return DateTime
         */
        public function utcNow() {
            $current_date = strtotime($this->toString("Y-m-d H:m:s"));
            $utc_date = getdate(strtotime(gmdate("Y-d-m H:m:s", $current_date)));
            return new DateTime($utc_date["year"], $utc_date["mon"], $utc_date["mday"], $utc_date["hours"], $utc_date["minutes"], $utc_date["seconds"]);
        }

        /**
         * Gets the year component of the date represented by this instance.
         * @access public
         * @return int The year, between 1970 and 9999.
         */
        public function year() {
            return $this->year;
        }

        /**
         * Override method __toString
         * @return string
         */
        public function __toString() {
            return $this->toString();
        }

        //PRIVATE METHODS

        /**
         * Method to calculate date like substract and add
         * @access private
         * @param string $value Value to used for calculate
         * @param object $parameter Parameter to be calculate
         */
        private function calculateDate($value, &$parameter) {
            $parameter += $value;
            $date = mktime($this->hours, $this->minutes, $this->seconds, $this->month, $this->day, $this->year);
            if (!$this->isValidYear(date("Y", $date))) throw new ArgumentOutOfRangeException("The resulting System.DateTime is less than System.DateTime.MinValue or greater than System.DateTime.MaxValue.");
            $this->changeValueOfAttributes($date);
        }

        /**
         * Method to help a validate state of DateAndTime Object
         * @access private
         * @param int $year Year to be validate
         * @return Boolean true if date is valid or false;
         */
        private function isValidYear($year) {
            if ($year > 2037 || $year < 1902) return false;
            return true;
        }

        /**
         * Method to reorganize object when any cal occours
         * @access private
         * @param string $date value in format string of date
         */
        private function changeValueOfAttributes($date) {
            $this->year = date("Y", $date);
            $this->month = date("m", $date);
            $this->day = date("d", $date);
            $this->hours = date("H", $date);
            $this->minutes = date("i", $date);
            $this->seconds = date("s", $date);
        }
    }
}
