<?php

namespace System\Globalization;

require_once(dirname(__FILE__).'/../ICloneable.php');

use System\ICloneable as ICloneable;
use System\DateTime as DateTime;
use System\DayOfWeek as DayOfWeek;


/**
 * Represents time in divisions, such as weeks, months, and years.
 * @access public
 * @name Calendar
 * @package System
 * @subpackage Globalization
 */
abstract class Calendar implements ICloneable {

    /**
     * Represents the current era of the current calendar.
     * @access public
     * @const
     */
    const CurrentEra = 0;

    /**
     * Initializes a new instance of the System.Globalization.Calendar class.
     * @access protected
     */
    protected function __construct() { }

    /**
     * Returns a System.DateTime that is the specified number of days away from the specified System.DateTime.
     * @access public
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to which to add days.
     * @param $days The number of days to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of days to the specified System.DateTime.
     */
    public function addDays(DateTime $time, $days) { }

    /**
     * Returns a System.DateTime that is the specified number of hours away from the specified System.DateTime.
     * @access public
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to which to add hours.
     * @param $hours The number of hours to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of hours to the specified System.DateTime.
     */
    public function addHours(DateTime $time, $hours) { }

    /**
     * Returns a System.DateTime that is the specified number of milliseconds away from the specified System.DateTime.
     * @access public
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to add milliseconds to.
     * @param $milliseconds The number of milliseconds to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of milliseconds to the specified System.DateTime.
     */
    public function addMilliseconds(DateTime $time, $milliseconds) { }

    /**
     * Returns a System.DateTime that is the specified number of minutes away from the specified System.DateTime.
     * @access public
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to which to add minutes.
     * @param $minutes The number of minutes to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of minutes to the specified System.DateTime.
     */
    public function addMinutes(DateTime $time, $minutes) { }

    /**
     * When overridden in a derived class, returns a System.DateTime that is the specified number of months away from the specified System.DateTime.
     * @abstract
     * @access public
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to which to add months.
     * @param $months The number of months to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of minutes to the specified System.DateTime.
     */
    public abstract function addMonths(DateTime $time, $months);


    /**
     * Returns a System.DateTime that is the specified number of seconds away from the specified System.DateTime.
     * @access public
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to which to add seconds.
     * @param $seconds The number of seconds to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of seconds to the specified System.DateTime.
     */
    public function addSeconds(DateTime $time, $seconds) { }

    /**
     * Returns a System.DateTime that is the specified number of weeks away from the specified System.DateTime.
     * @access public
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to which to add weeks.
     * @param $weeks The number of weeks to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of weeks to the specified System.DateTime.
     */
    public function addWeeks(DateTime $time, $weeks) { }

    /**
     * When overridden in a derived class, returns a System.DateTime that is the specified number of years away from the specified System.DateTime.
     * @access public
     * @abstract
     * @throws \System\ArgumentException|\System\ArgumentOutOfRangeException
     * @param \System\DateTime $time The System.DateTime to which to add years.
     * @param $years The number of years to add.
     * @return \System\DateTime The System.DateTime that results from adding the specified number of years to the specified System.DateTime.
     */
    public abstract function addYears(DateTime $time, $years);

    /**
     * When overridden in a derived class, returns the day of the month in the specified System.DateTime.
     * @access public
     * @abstract
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int A positive integer that represents the day of the month in the time parameter.
     */
    public abstract function getDayOfMonth(DateTime $time);

    /**
     * When overridden in a derived class, returns the day of the week in the specified System.DateTime.
     * @abstract
     * @access public
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int A System.DayOfWeek value that represents the day of the week in the time parameter.
     */
    public abstract function getDayOfWeek(DateTime $time);

    /**
     * When overridden in a derived class, returns the day of the year in the specified System.DateTime.
     * @abstract
     * @access public
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int A positive integer that represents the day of the year in the time parameter.
     */
    public abstract function getDayOfYear(DateTime $time);

    /**
     * When overridden in a derived class, returns the number of days in the specified month, year, and era.
     * @abstract
     * @access public
     * @throws \System\ArgumentOutOfRangeException|
     * @param $year An integer that represents the year.
     * @param $month A positive integer that represents the month.
     * @param object $era An integer that represents the era.
     * @return The number of days in the specified month in the specified year in the specified era.
     */
    public abstract function getDaysInMonth($year, $month, $era=null);

    /**
     * When overridden in a derived class, returns the number of days in the specified year and era.
     * @access public
     * @abstract
     * @throws \System\ArgumentOutOfRangeException
     * @param $year An integer that represents the year.
     * @param object $era An integer that represents the era.
     * @return int The number of days in the specified year in the specified era.
     */
    public abstract function getDaysInYear($year, $era=null);

    /**
     * When overridden in a derived class, returns the era in the specified System.DateTime.
     * @access public
     * @abstract
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int An integer that represents the era in time.
     */
    public abstract function getEra(DateTime $time);

    /**
     * Returns the hours value in the specified System.DateTime.
     * @access public
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int An integer from 0 to 23 that represents the hour in time.
     */
    public function getHour(DateTime $time) { }

    /**
     * Calculates the leap month for a specified year.
     * @access public
     * @param $year A year.
     * @param $era An era.
     * @return A positive integer that indicates the leap month in the specified year and era. -or-  Zero if this calendar does not support a leap month or if the year and era parameters do not specify a leap year.
     */
    public function getLeapMonth($year, $era=null) { }

    /**
     * Returns the milliseconds value in the specified System.DateTime.
     * @access public
     * @param \System\DateTime $time The System.DateTime to read.
     * @return double A double-precision floating-point number from 0 to 999 that represents the milliseconds in the time parameter.
     */
    public function getMilliseconds(DateTime $time) { }

    /**
     * Returns the minutes value in the specified System.DateTime.
     * @access public
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int An integer from 0 to 59 that represents the minutes in time.
     */
    public function getMinute(DateTime $time) { }

    /**
     * When overridden in a derived class, returns the month in the specified System.DateTime.
     * @access public
     * @abstract
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int A positive integer that represents the month in time.
     */
    public abstract function getMonth(DateTime $time);

    /**
     * Returns the number of months in the specified year in the current era.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param $year An integer that represents the year.
     * @param $era An integer that represents the era.
     * @return int The number of months in the specified year in the specified era.
     */
    public function getMonthsInYear($year, $era=null) { }

    /**
     * Returns the seconds value in the specified System.DateTime.
     * @access public
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int An integer from 0 to 59 that represents the seconds in time.
     */
    public function getSecond(DateTime $time) { }

    /**
     * Returns the week of the year that includes the date in the specified System.DateTime.
     * @access public
     * @param \System\DateTime $time The System.DateTime to read.
     * @param \System\Globalization\CalendarWeekRule $rule A System.Globalization.CalendarWeekRule value that defines a calendar week.
     * @param \System\DayOfWeek $firstDayOfWeek A System.DayOfWeek value that represents the first day of the week.
     * @return int A positive integer that represents the week of the year that includes the date in the time parameter.
     */
    public function getWeekOfYear(DateTime $time, CalendarWeekRule $rule, DayOfWeek $firstDayOfWeek) { }

    /**
     * When overridden in a derived class, returns the year in the specified System.DateTime.
     * @access public
     * @abstract
     * @param \System\DateTime $time The System.DateTime to read.
     * @return int An integer that represents the year in time.
     */
    public abstract function getYear(DateTime $time);

    /**
     * When overridden in a derived class, determines whether the specified date in the specified era is a leap day.
     * @access public
     * @abstract
     * @throws \System\ArgumentOutOfRangeException
     * @param $year An integer that represents the year.
     * @param $month A positive integer that represents the month.
     * @param $day A positive integer that represents the day.
     * @param object $era An integer that represents the era.
     * @return bool true if the specified day is a leap day; otherwise, false.
     */
    public abstract function isLeapDay($year, $month, $day, $era=null);

    /**
     * When overridden in a derived class, determines whether the specified month in the specified year in the specified era is a leap month.
     * @access public
     * @abstract
     * @throws \System\ArgumentOutOfRangeException
     * @param $year An integer that represents the year.
     * @param $month A positive integer that represents the month.
     * @param object $era An integer that represents the era.
     * @return bool true if the specified month is a leap month; otherwise, false.
     */
    public abstract function isLeapMonth($year, $month, $era=null);

    /**
     * When overridden in a derived class, determines whether the specified year in the specified era is a leap year.
     * @access public
     * @abstract
     * @throws \System\ArgumentOutOfRangeException
     * @param $year An integer that represents the year.
     * @param object $era An integer that represents the era.
     * @return bool true if the specified year is a leap year; otherwise, false.
     */
    public abstract function isLeapYear($year, $era=null);

    /**
     * Returns a read-only version of the specified System.Globalization.Calendar object.
     * @access public
     * @static
     * @throws \System\ArgumentNullException
     * @param \System\Globalization\Calendar $calendar A System.Globalization.Calendar object.
     * @return \System\Globalization\Calendar The System.Globalization.Calendar object specified by the calendar parameter, if calendar is read-only. -or- A read-only memberwise clone of the System.Globalization.Calendar object specified by calendar, if calendar is not read-only.
     */
    public static function readOnly(Calendar $calendar) { }

    /**
     * When overridden in a derived class, returns a System.DateTime that is set to the specified date and time in the specified era.
     * @abstract
     * @throws \System\ArgumentOutOfRangeException
     * @param $year An integer that represents the year.
     * @param $month A positive integer that represents the month.
     * @param $day A positive integer that represents the day.
     * @param $hour An integer from 0 to 23 that represents the hour.
     * @param $minute An integer from 0 to 59 that represents the minute.
     * @param $second An integer from 0 to 59 that represents the second.
     * @param $millisecond An integer from 0 to 999 that represents the millisecond.
     * @param object $era An integer that represents the era.
     * @return \System\DateTime The System.DateTime that is set to the specified date and time in the current era.
     */
    public abstract function toDateTime($year, $month, $day, $hour, $minute, $second, $millisecond, $era=null);

    /**
     * Converts the specified year to a four-digit year by using the System.Globalization.Calendar.TwoDigitYearMax property to determine the appropriate century.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param $year A two-digit or four-digit integer that represents the year to convert.
     * @return int An integer that contains the four-digit representation of year.
     */
    public function toFourDigitYear($year) { }

    /**
     * Gets a value indicating whether the current calendar is solar-based, lunar-based, or a combination of both.
     * @access public
     * @return \System\Globalization\CalendarAlgorithmType One of the System.Globalization.CalendarAlgorithmType values.
     */
    public function algorithmType() { }

    /**
     * When overridden in a derived class, gets the list of eras in the current calendar.
     * @access public
     * @return array An array of integers that represents the eras in the current calendar.
     */
    public abstract function eras();

    /**
     * Gets a value indicating whether this System.Globalization.Calendar object is read-only.
     * @access public
     * @return bool true if this System.Globalization.Calendar object is read-only; otherwise, false.
     */
    public function isReadOnly() { }

    /**
     * Gets the latest date and time supported by this System.Globalization.Calendar object.
     * @access public
     * @return \System\DateTime The latest date and time supported by this calendar. The default is System.DateTime.MaxValue.
     */
    public function maxSupportedDateTime() { }

    /**
     * Gets the earliest date and time supported by this System.Globalization.Calendar object.
     * @access public
     * @return \System\DateTime The earliest date and time supported by this calendar. The default is System.DateTime.MinValue.
     */
    public function minSupportedDateTime() { }

    /**
     * Gets or sets the last year of a 100-year range that can be represented by a 2-digit year.
     * @access public
     * @param object $value sets the last year
     * @return int The last year of a 100-year range that can be represented by a 2-digit year.
     */
    public function twoDigitYearMax($value=null) { }
}
?>
