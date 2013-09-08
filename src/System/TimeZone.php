<?php

namespace {

    /**
     * Represents a time zone. 
     * @access public
     * @package System
     * @name TimeZone
     */
    abstract class TimeZone {

        /**
         * Returns the daylight saving time period for a particular year.
         * @access public
         * @abstract
         * @param $year The year that the daylight saving time period applies to.
         * @return \System\Globalization\DaylightTime A \System\Globalization\DaylightTime object that contains the start and end date for daylight saving time in year.
         */
        public abstract function getDaylightChanges($year);

        /**
         * Returns the Coordinated Universal Time (UTC) offset for the specified local time.
         * @access public
         * @abstract
         * @param $time A date and time value.
         * @return The Coordinated Universal Time (UTC) offset from Time.
         */
        public abstract function getUtcOffset($time);

        /**
         * Returns a value indicating whether the specified date and time is within a daylight saving time period.
         * @access public
         * @param $time A date and time.
         * @param $daylightTimes A daylight saving time period.
         * @return true if time is in a daylight saving time period; otherwise, false.
         */
        public function isDaylightSavingTime($time, $dayligthTimes) { }

        /**
         * Returns the local time that corresponds to a specified date and time value.
         * @access public
         * @param $time A Coordinated Universal Time (UTC) time.
         * @return A \System\DateTime object whose value is the local time that corresponds to time.
         */
        public function toLocalTime($time) { }

        /**
         * Returns the Coordinated Universal Time (UTC) that corresponds to a specified time.
         * @access public
         * @param $time A date and time.
         * @return A \System\DateTime object whose value is the Coordinated Universal Time (UTC) that corresponds to time.
         */
        public function toUniversalTime($time) { }

        /**
         * Gets the time zone of the current computer.
         * @access public
         * @static
         * @return A \System\TimeZone object that represents the current local time zone.
         */
        public static function currentTimeZone() { 
            
        }

        /**
         * Gets the daylight saving time zone name.
         * @access public
         * @abstract
         * @return The daylight saving time zone name.
         */
        public abstract  function dayligthName();

        /**
         * Gets the standard time zone name.
         * @abstract
         * @param The standard time zone name.
         */
        public abstract function standardName();
    }
}