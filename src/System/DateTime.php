<?php

namespace System 
{
    use \System\Runtime\Serialization\ISerializable as ISerializable;

    /**
     * Represents an instant in time, typically expressed as a date and time of day.
     *
     * @access public
     * @package System
     * @name DateTime
     */
    final class DateTime implements IComparable, IFormattable, IConvertible, ISerializable, IEquatable
    {
        private $year;
        private $month;
        private $day;
        private $hours;
        private $minutes;
        private $seconds;
        protected $kind;

        /**
         * Initializes a new instance of the DateTime structure.
         *
         * @access public
         * @throws \System\ArgumentOutOfRangeException year is less than 1902 or greater than 2037. -or-  month is less than 1 or greater than 12. -or-  day is less than 1 or greater than the number of days in month -or- hour is less than 0 or greater than 23 -or- minute is less than 0 or greater than 59 -or- second is less than 0 or greater than 59.
         * @param int $year The year (1902 through 2037).
         * @param int $month The month (1 through 12).
         * @param int $day The day (1 through the number of days in month).
         * @param int $hours The hours (0 through 23).
         * @param int $minutes The minutes (0 through 59).
         * @param int $seconds The seconds (0 through 59).
         */
        public function  __construct($year, $month, $day, $hours = 0, $minutes = 0, $seconds = 0) 
        {
            if(!$this->isValidYear($year))
            {
                throw new ArgumentOutOfRangeException("year is less than 1902 or greater than 2037.");
            }

            if ($month < 1 or $month > 12)
            {
                throw new ArgumentOutOfRangeException("month is less than 1 or greater than 12.");
            }

            if (!checkdate($month, $day, $year))
            {
                throw new ArgumentOutOfRangeException("day is less than 1 or greater than the number of days in month");
            }

            if ($hours < 0 or $hours > 23)
            {
                throw new ArgumentOutOfRangeException("hour is less than 0 or greater than 23");
            }

            if ($minutes < 0 or $minutes > 59)
            {
                throw new ArgumentOutOfRangeException("minute is less than 0 or greater than 59");
            }

            if ($seconds < 0 or $seconds > 59)
            {
                throw new ArgumentOutOfRangeException("second is less than 0 or greater than 59.");
            }

            $this->year = $year;
            $this->month = $month;
            $this->day = $day;
            $this->hours = $hours;
            $this->minutes = $minutes;
            $this->seconds = $seconds;
            $this->kind = DateTimeKind::unespecified();
        }

        /**
         * Adds the value of the specified System.TimeSpan to the value of this instance.
         * @access public
         * @param TimeSpan $value A System.TimeSpan object that represents a positive or negative time interval.
         * @return DateTime A System.DateTime whose value is the sum of the date and time represented by this instance and the time interval represented by value.
         */
        public function add(TimeSpan $value) 
        {
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


        public function addMilliseconds()
        {

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

        public function addTicks()
        {

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

        public function equals($other)
        {

        }

        public function fromBinary()
        {

        }

        public function fromFileTime()
        {

        }

        public function fromFileTimeUtc()
        {

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
         * Populates a SerializationInfo with the data needed to serialize the target object.
         *
         * @access public
         * @throws \System\Security\SecurityException The caller does not have the required permission.
         * @param \System\Runtime\Serialization\SerializationInfo $info The System.Runtime.Serialization.SerializationInfo to populate with data.
         * @param \System\Runtime\Serialization\StreamingContext $context The destination for this serialization.
         */
        public function getObjectData($info, $context)
        {

        }

        public function getType()
        {

        }

        public function getTypeCode()
        {

        }

        /**
         * Gets the hour component of the date represented by this instance.
         * @access public
         * @return int The hour component, expressed as a value between 0 and 23.
         */
        public function hour() 
        {
            return $this->hours;
        }


        /**
         * Indicates whether this instance of System.DateTime is within the Daylight Saving Time range for the current time zone.
         * @access public
         * @return bool true if System.DateTime.Kind is System.DateTimeKind.Local or System.DateTimeKind.Unspecified and the value of this instance of System.DateTime is within the Daylight Saving Time range for the current time zone. false if System.DateTime.Kind is System.DateTimeKind.Utc.
         */
        public function isDaylightSavingTime() 
        {
            return $this->toString("I") == 1;
        }

        /**
         * Returns an indication whether the specified year is a leap year.
         * @access public
         * @static
         * @param int $year A 4-digit year.
         * @return bool true if year is a leap year; otherwise, false.
         */
        public static function isLeapYear($year) 
        {
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

        public function maxValue()
        {

        }

        public function millisecond()
        {

        }

        public function minValue()
        {

        }


        /**
         * Gets the minute component of the date represented by this instance.
         * @access public
         * @return int The minute component, expressed as a value between 0 and 59.
         */
        public function minute() {
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
        public static function now() 
        {
            $date = getdate();
            return new DateTime($date["year"], $date["mon"], $date["mday"], $date["hours"], $date["minutes"], $date["seconds"]);
        }


        /**
         * Converts the specified string representation of a date and time to its DateTime equivalent.
         * @access public
         * @static
         * @throws \System\ArgumentNullException s is null.
         * @throws \System\FormatException Format is invalid.
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

        public function parseExact()
        {

        }

        /**
        * Gets the seconds component of the date represented by this instance.
        * @access public
        * @return int The seconds, between 0 and 59.
        */
        public function second() {
            return $this->seconds;
        }

        /**
         * Creates a new DateTime object that represents the same time as the specified DateTime, but is designated in either local time, Coordinated Universal Time (UTC), or neither, as indicated by the specified DateTimeKind value.
         * @static
         * @param DateTime $value
         * @param \System\DateTimeKind $kind
         * @return \System\DateTime A new DateTime object consisting of the same time represented by the value parameter and the DateTimeKind value specified by the kind parameter.
         */
        public static function specifyKind(DateTime $value, DateTimeKind $kind) 
        {
            $value->kind = $kind;
            return $kind == DateTimeKind::utc() ? $value->utcNow() : $value;
        }


        /**
         * Subtracts the specified date and time from this instance.
         * @access public
         * @param \System\DateTime $value An instance of System.DateTime. -or- An instance of System.TimeSpan
         * @return \System\TimeSpan A System.TimeSpan interval equal to the date and time represented by this instance minus the date and time represented by value.
         */
        public function subtract($value) 
        {
            if ($value instanceof DateTime)
            {
                return $this->subtractDate($value);
            }
            elseif ($value instanceof TimeSpan)
            {
                return $this->subtractTimeSpan($value);
            }
            else
            {
                return null;
            }
        }

        private function subtractDate($value) {
            $year = $this->year() - $value->year();
            $month = $this->month() - $value->month();
            $day = $this->day() - $value->day();
            $hours = $this->hour() - $value->hour();
            $minutes = $this->minute() - $value->minute();
            $seconds = $this->second() - $value->second();
            $day = $day + ($month * 30.5) + ($year * 365.25);
            return new TimeSpan($day, $hours, $minutes, $seconds);
        }

        private function subtractTimeSpan($value) {
            $day = $this->day() - $value->days();
            $hours = $this->hour() - $value->hours();
            $minutes = $this->minute() - $value->minutes();
            $seconds = $this->second() - $value->seconds();
            return new TimeSpan($day, $hours, $minutes, $seconds);
        }


        public function ticks()
        {

        }

        public function timeOfDay()
        {

        }

        public function toBinary()
        {

        }

        /**
         * Converts the value of this instance to an equivalent Boolean value using the specified culture-specific formatting information.
         *
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Boolean A Boolean value equivalent to the value of this instance.
         */
        public function toBoolean(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of this instance to an equivalent 8-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Byte An 8-bit unsigned integer equivalent to the value of this instance.
         */
        public function toByte(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of this instance to an equivalent Unicode character using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Char A Unicode character equivalent to the value of this instance.
         */
        public function toChar(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of this instance to an equivalent System.DateAndTime using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\DateTime A System.DateTime instance equivalent to the value of this instance.
         */
        public function toDateTime(IFormatProvider $provider = null)
        {

        }

        /**
         * Gets the current date.
         * @access public
         * @static
         * @return \System\DateTime A System.DateTime set to today's date, with the time component set to 00:00:00.
         */
        public static function today() 
        {
            $now = self::now();
            return $now->date();
        }

        /**
         * Converts the value of this instance to an equivalent System.Decimal number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return Decimal A System.Decimal number equivalent to the value of this instance.
         */
        public function toDecimal(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of this instance to an equivalent double-precision floating-point number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Double A double-precision floating-point number equivalent to the value of this instance.
         */
        public function toDouble(IFormatProvider $provider = null)
        {

        }


        public function toFileTime()
        {

        }

        public function toFileTimeUtc()
        {

        }

        /**
         * Converts the value of this instance to an equivalent 16-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int16 An 16-bit signed integer equivalent to the value of this instance.
         */
        public function toInt16(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of this instance to an equivalent 32-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int32 An 32-bit signed integer equivalent to the value of this instance.
         */
        public function toInt32(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of this instance to an equivalent 64-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int64 An 64-bit signed integer equivalent to the value of this instance.
         */
        public function toInt64(IFormatProvider $provider = null)
        {

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
         * Converts the value of this instance to an equivalent 8-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\SByte An 8-bit signed integer equivalent to the value of this instance.
         */
        public function toSByte(IFormatProvider $provider = null)
        {

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
         * Converts the value of this instance to an equivalent single-precision floating-point number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Single A single-precision floating-point number equivalent to the value of this instance.
         */
        public function toSingle(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of the current System.DateTime object to its equivalent string representation.
         *
         * @access public
         * @param string $format A format string.
         * @return string A string representation of value of this instance as specified by format.
         */
        public function toString($format = "", IFormatProvider $provider = null) 
        {
            if (strlen($format) > 0) return date($format, mktime($this->hours, $this->minutes, $this->seconds, $this->month, $this->day, $this->year));
            return $this->year . "-" . $this->month . "-" . $this->day . " " . $this->hours . ":" . $this->minutes . ":" . $this->seconds;
        }

        /**
         * Converts the value of the current System.DateTime object to its equivalent string representation.
         *
         * @access public
         * @return string A string representation of value of this instance as specified by format.
         */
        public function __toString() {
            return $this->toString();
        }

        /**
         * Converts the value of this instance to an System.Object of the specified System.Type that has an equivalent value, using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\Type $conversionType The System.Type to which the value of this instance is converted.
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return Type An System.Object instance of type conversionType whose value is equivalent to the value of this instance.
         */
        public function toType(Type $conversionType, IFormatProvider $provider)
        {

        }

        /**
         * Converts the value of this instance to an equivalent 16-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt16 An 16-bit unsigned integer equivalent to the value of this instance.
         */
        public function toUInt16(IFormatProvider $provider = null)
        {

        }

        /**
         * Converts the value of this instance to an equivalent 32-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt32 An 32-bit unsigned integer equivalent to the value of this instance.
         */
        public function toUInt32(IFormatProvider $provider = null)
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 64-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt64 An 64-bit unsigned integer equivalent to the value of this instance.
         */
        public function toUInt64(IFormatProvider $provider = null)
        {
            
        }

        /**
         * Converts the value of the current DateTime object to Coordinated Universal Time (UTC).
         * @access public
         * @return \System\DateTime A DateTime object whose Kind property is Utc, and whose value is the UTC equivalent to the value of the current DateTime object, or MaxValue if the converted value is too large to be represented by a DateTime object, or MinValue if the converted value is too small to be represented by a DateTime object.
         */
        public function toUniversalTime() 
        {
            return $this->utcNow();
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
            try 
            {
                $result = self::parse($s);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }


        public function tryParseExact()
        {

        }
        

        /**
         * Gets a DateTime object that is set to the current date and time on this computer, expressed as the Coordinated Universal Time (UTC).
         * @access public
         * @return DateTime
         */
        public function utcNow() 
        {
            $current_date = strtotime($this->toString("Y-m-d H:m:s"));
            $utc_date = getdate(strtotime(gmdate("Y-m-d H:m:s", $current_date)));
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
            
            if (!$this->isValidYear(date("Y", $date))) 
            {
                throw new ArgumentOutOfRangeException("The resulting System.DateTime is less than System.DateTime.MinValue or greater than System.DateTime.MaxValue.");
            }
            
            $this->changeValueOfAttributes($date);
        }

        /**
         * Method to help a validate state of DateAndTime Object
         * @access private
         * @param int $year Year to be validate
         * @return Boolean true if date is valid or false;
         */
        private function isValidYear($year) 
        {
            return $year >= 1902 and $year <= 2037;
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
