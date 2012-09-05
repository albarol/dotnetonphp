<?php

namespace System\Globalization;

require_once dirname(__FILE__) . "/../ICloneable.php";

use System\ICloneable as ICloneable;
use System\IFormatProvider as IFormatProvider;
use System\DayOfWeek as DayOfWeek;

/**
 * Defines how System.DateTime values are formatted and displayed, depending on the culture.
 * @access public
 * @name DateTimeFormatInfo
 * @package System
 * @subpackage Globalization
 */
final class DateTimeFormatInfo implements ICloneable, IFormatProvider {

    /**
     * Initializes a new writable instance of the System.Globalization.DateTimeFormatInfo class that is culture-independent (invariant).
     */
    public function __construct() { }


    /**
     * Returns the culture-specific abbreviated name of the specified day of the week based on the culture associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param \System\DayOfWeek $dayOfWeek A System.DayOfWeek value.
     * @return string The culture-specific abbreviated name of the day of the week represented by dayofweek.
     */
    public function getAbbreviatedDayName(DayOfWeek $dayOfWeek) { }


    /**
     * Returns the string containing the abbreviated name of the specified era, if an abbreviation exists.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param $era The integer representing the era.
     * @return string A string containing the abbreviated name of the specified era, if an abbreviation exists. -or- A string containing the full name of the era, if an abbreviation does not exist.
     */
    public function getAbbreviatedEraName($era) { }

    /**
     * Returns the culture-specific abbreviated name of the specified month based on the culture associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param $month An integer from 1 through 13 representing the name of the month to retrieve.
     * @return string The culture-specific abbreviated name of the month represented by month.
     */
    public function getAbbreviatedMonthName($month) { }

    /**
     * Returns all the standard patterns in which System.DateTime values can be formatted.
     * @access public
     * @throws ArgumentException
     * @param object $format A standard format pattern.
     * @return array An array containing the standard patterns in which System.DateTime values can be formatted.
     */
    public function getAllDateTimePatterns($format=null) { }


    /**
     * Returns the culture-specific full name of the specified day of the week based on the culture associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @param \System\DayOfWeek $dayOfWeek A System.DayOfWeek value.
     * @return string The culture-specific full name of the day of the week represented by dayofweek.
     */
    public function getDayName(DayOfWeek $dayOfWeek) { }

    /**
     * Returns the integer representing the specified era.
     * @access public
     * @throws \System\ArgumentNullException
     * @param $eraName The string containing the name of the era.
     * @return int The integer representing the era, if eraName is valid; otherwise, -1.
     */
    public function getEra($eraName) { }

    /**
     * Returns the string containing the name of the specified era.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param $era The integer representing the era.
     * @return string A string containing the name of the era.
     */
    public function getEraName($era) { }

    /**
     * Returns an object that provides formatting services for the specified type.
     * @param $formatType An object that specifies the type of format object to return.
     * @return An instance of the object specified by formatType, if the System.IFormatProvider implementation can supply that type of object; otherwise, null.
     */
    public function getFormat($formatType) { }

    /**
     * Returns the System.Globalization.DateTimeFormatInfo associated with the specified System.IFormatProvider.
     * @access public
     * @static
     * @param \System\IFormatProvider $provider The System.IFormatProvider that gets the System.Globalization.DateTimeFormatInfo. -or- null to get System.Globalization.DateTimeFormatInfo.CurrentInfo.
     * @return \System\Globalization\DateTimeFormatInfo A System.Globalization.DateTimeFormatInfo associated with the specified System.IFormatProvider.
     */
    public static function getInstance(IFormatProvider $provider) { }

    /**
     * Returns the culture-specific full name of the specified month based on the culture associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param $month An integer from 1 through 13 representing the name of the month to retrieve.
     * @return string The culture-specific full name of the month represented by month.
     */
    public function getMonthName($month) { }

    /**
     * Obtains the shortest abbreviated day name for a specified day of the week associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @param \System\DayOfWeek $dayOfWeek One of the System.DayOfWeek values.
     * @return string The abbreviated name of the week that corresponds to the dayOfWeek parameter.
     */
    public function getShortestDayName(DayOfWeek $dayOfWeek) { }

    /**
     * Returns a read-only System.Globalization.DateTimeFormatInfo wrapper.
     * @access public
     * @static
     * @throws \System\ArgumentNullException
     * @param \System\Globalization\DateTimeFormatInfo $dtif The System.Globalization.DateTimeFormatInfo to wrap.
     * @return \System\Globalization\DateTimeFormatInfo The System.Globalization.DateTimeFormatInfo to wrap.
     */
    public static function readOnly(DateTimeFormatInfo $dtif) { }


    /**
     * Sets all the standard patterns in which a System.DateTime value can be formatted.
     * @access public
     * @param $patterns A string array of format patterns.
     * @param $format The standard format pattern associated with the patterns specified in the patterns parameter.
     */
    public function setAllDateTimePatterns($patterns, $format) { }

    /**
     * Gets or sets a one-dimensional array of type System.String containing the culture-specific abbreviated names of the days of the week.
     * @access public
     * @throws \System\ArgumentNullException|\System\ArgumentException|\System\InvalidOperationException
     * @param object $value sets a one-dimensional array of type System.String
     * @return array A one-dimensional array of type System.String containing the culture-specific abbreviated names of the days of the week. The array for System.Globalization.DateTimeFormatInfo.InvariantInfo contains "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", and "Sat".
     */
    public function abbreviatedDayNames($value=null) { }


    /**
     * Gets or sets a string array of abbreviated month names associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @throws \System\ArgumentNullException
     * @param $value sets a string array of abbreviated month
     * @return array A string array of abbreviated month names.
     */
    public function abbreviatedMonthGenitiveNames($value=null) { }

    /**
     * Gets or sets a one-dimensional array of type System.String containing the culture-specific abbreviated names of the months.
     * @access public
     * @throws \System\ArgumentNullException|\System\ArgumentException|\System\InvalidOperationException
     * @param $value  sets a one-dimensional array of type System.String containing the culture-specific abbreviated names of the months
     * @return array A one-dimensional array of type System.String containing the culture-specific abbreviated names of the months. In a 12-month calendar, the 13th element of the array is an empty string. The array for System.Globalization.DateTimeFormatInfo.InvariantInfo contains "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", and "".
     */
    public function abbreviatedMonthNames($value=null) { }

    /**
     * Gets or sets the string designator for hours that are "ante meridiem" (before noon).
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param $value sets the string designator for hours that are "ante meridiem" (before noon)
     * @return string The string designator for hours that are "ante meridiem" (before noon). The default for System.Globalization.DateTimeFormatInfo.InvariantInfo is "AM".
     */
    public function aMDesignator($value=null) { }

    /**
     * Gets or sets the calendar to use for the current culture.
     * @access public
     * @throws \System\ArgumentNullException|\System\ArgumentException|\System\InvalidOperationException
     * @param $value sets the calendar to use for the current culture.
     * @return \System\Globalization\Calendar The System.Globalization.Calendar indicating the calendar to use for the current culture. The default for System.Globalization.DateTimeFormatInfo.InvariantInfo is the System.Globalization.GregorianCalendar.
     */
    public function calendar($value=null) { }

    /**
     * Gets or sets a value that specifies which rule is used to determine the first calendar week of the year.
     * @access public
     * @throws \System\ArgumentOutOfRangeException
     * @param null $value
     */
    public function calendarWeekRule($value=null) { }

    /**
     * Gets a read-only System.Globalization.DateTimeFormatInfo object that formats values based on the current culture.
     * @access public
     * @static
     * @return \System\Globalization\DateTimeFormatInfo A read-only System.Globalization.DateTimeFormatInfo object based on the System.Globalization.CultureInfo object for the current thread.
     */
    public static function currentInfo() { }

    /**
     * Gets or sets a one-dimensional array of type System.String containing the culture-specific full names of the days of the week.
     * @access public
     * @throws \System\ArgumentNullException|\System\ArgumentException|\System\InvalidOperationException
     * @param $value A one-dimensional array of type System.String containing the culture-specific full names of the days of the week. The array for System.Globalization.DateTimeFormatInfo.InvariantInfo contains "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", and "Saturday".
     */
    public function dayNames($value=null) { }

    /**
     * Gets or sets the first day of the week.
     * @access public
     * @param $value sets the first day of the week.
     * @return DayOfWeek A System.DayOfWeek value representing the first day of the week. The default for System.Globalization.DateTimeFormatInfo.InvariantInfo is System.DayOfWeek.Sunday.
     */
    public function firstDayOfWeek($value=null) { }

    /**
     * Gets or sets the format pattern for a long date and long time value, which is associated with the "F" format pattern.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param $value sets the format pattern for a long date and long time value
     * @return string The format pattern for a long date and long time value, which is associated with the "F" format pattern.
     */
    public function fullDateTimePattern($value=null) { }

    /**
     * Gets the default read-only System.Globalization.DateTimeFormatInfo that is culture-independent (invariant).
     * @access public
     * @static
     * @return \System\Globalization\DateTimeFormatInfo The default read-only System.Globalization.DateTimeFormatInfo object that is culture-independent (invariant).
     */
    public static function invariantInfo() { }

    /**
     * Gets a value indicating whether the System.Globalization.DateTimeFormatInfo object is read-only.
     * @access public
     * @return bool true if the System.Globalization.DateTimeFormatInfo object is read-only; otherwise, false.
     */
    public function isReadOnly() { }

    /**
     * Gets or sets the format pattern for a long date value, which is associated with the "D" format pattern.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param $value sets the format pattern for a long date value
     * @return The format pattern for a long date value, which is associated with the "D" format pattern.
     */
    public function longDatePattern($value=null) { }

    /**
     * Gets or sets the format pattern for a long time value, which is associated with the "T" format pattern.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param $value sets the format pattern for a long time value
     * @return string The format pattern for a long time value, which is associated with the "T" format pattern.
     */
    public function longTimePattern($value=null) { }

    /**
     * Gets or sets the format pattern for a month and day value, which is associated with the "m" and "M" format patterns.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param $value sets the format pattern for a month and day value
     * @return string The format pattern for a month and day value, which is associated with the "m" and "M" format patterns.
     */
    public function monthDayPattern($value=null) { }

    /**
     * Gets or sets a string array of month names associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @throws \System\ArgumentNullException
     * @param $value sets a string array of month names associated with the current System.Globalization.DateTimeFormatInfo object.
     * @return array A string array of month names.
     */
    public function monthGenitiveDays($value=null) { }

    /**
     * Gets or sets a one-dimensional array of type System.String containing the culture-specific full names of the months.
     * @access public
     * @throws \System\ArgumentNullException|\System\ArgumentException|\System\InvalidOperationException
     * @param $value sets a one-dimensional array of type System.String
     * @return array A one-dimensional array of type System.String containing the culture-specific full names of the months. In a 12-month calendar, the 13th element of the array is an empty string. The array for System.Globalization.DateTimeFormatInfo.InvariantInfo contains "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", and "".
     */
    public function monthNames($value=null) { }

    /**
     * Gets the native name of the calendar associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @return string The native name of the calendar used in the culture associated with the current System.Globalization.DateTimeFormatInfo object if that name is available, or the empty string ("") if the native calendar name is not available.
     */
    public function nativeCalendarName() { }

    /**
     * Gets or sets the string designator for hours that are "post meridiem" (after noon).
     * @access public
     * @param $value sets the string designator for hours that are "post meridiem" (after noon).
     * @return string The string designator for hours that are "post meridiem" (after noon). The default for System.Globalization.DateTimeFormatInfo.InvariantInfo is "PM".
     */
    public function pMDesignator($value=null) { }

    /**
     * Gets the format pattern for a time value, which is based on the Internet Engineering Task Force (IETF) Request for Comments (RFC) 1123 specification and is associated with the "r" and "R" format patterns.
     * @access public
     * @return string The format pattern for a time value, which is based on the IETF RFC 1123 specification and is associated with the "r" and "R" format patterns.
     */
    public function rFC1123Pattern() {}

    /**
     * Gets or sets the format pattern for a short date value, which is associated with the "d" format pattern.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param object $value sets the format pattern for a short date value
     * @return string The format pattern for a short date value, which is associated with the "d" format pattern.
     */
    public function shortDatePattern($value=null) {}

    /**
     * Gets or sets a string array of the shortest unique abbreviated day names associated with the current System.Globalization.DateTimeFormatInfo object.
     * @access public
     * @throws \System\ArgumentNullException
     * @param object $value sets a string array of the shortest unique abbreviated day names
     * @return array A string array of day names.
     */
    public function shortestDayNames($value=null) {}

    /**
     * Gets or sets the format pattern for a short time value, which is associated with the "t" format pattern.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param object $value sets the format pattern for a short time value
     * @return string The format pattern for a short time value, which is associated with the "t" format pattern.
     */
    public function shortTimePattern($value=null) { }

    /**
     * Gets the format pattern for a sortable date and time value, which is associated with the "s" format pattern.
     * @access public
     * @return string The format pattern for a sortable date and time value, which is associated with the "s" format pattern.
     */
    public function sortableDateTimePattern() {}

    /**
     * Gets or sets the string that separates the components of time, that is, the hour, minutes, and seconds.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param object $value sets the string that separates the components of time, that is, the hour, minutes, and seconds.
     * @return string The string that separates the components of time. The default for System.Globalization.DateTimeFormatInfo.InvariantInfo is ":".
     */
    public function timeSeparator($value=null) { }

    /**
     * Gets the format pattern for a universal sortable date and time value, which is associated with the "u" format pattern.
     * @access public
     * @return string The format pattern for a universal sortable date and time value, which is associated with the "u" format pattern.
     */
    public function universalSortableDateTimePattern() { }

    /**
     * Gets or sets the format pattern for a year and month value, which is associated with the "y" and "Y" format patterns.
     * @access public
     * @throws \System\ArgumentNullException|\System\InvalidOperationException
     * @param object $value sets the format pattern for a year and month value
     * @return string The format pattern for a year and month value, which is associated with the "y" and "Y" format patterns.
     */
    public function yearMonthPattern($value=null) { }

    /**
     * Creates a new object that is a copy of the current instance.
     * @access public
     * @return Object A new object that is a copy of this instance.
     */
    public function cloneObject() { }
}


?>
