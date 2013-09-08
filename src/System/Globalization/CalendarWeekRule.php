<?php

namespace System\Globalization
{

    use System\Enum as Enum;


    /**
     * Defines different rules for determining the first week of the year.
     * @access public
     * @name CalendarWeekRule
     * @package System
     * @subpackage Globalization
     */
    class CalendarWeekRule extends Enum 
    {
        private function __construct($name, $value) 
        {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Indicates that the first week of the year starts on the first day of the year and ends before the following designated first day of the week. The value is 0.
         * @access public
         * @return \System\Globalization\CalendarWeekRule
         */
        public static function firstDay() 
        {
            return new CalendarWeekRule("FirstDay", 0);
        }

        /**
         * Indicates that the first week of the year is the first week with four or more days before the designated first day of the week. The value is 2.
         * @access public
         * @return \System\Globalization\CalendarWeekRule
         */
        public static function firstFourDayWeek() 
        {
            return new CalendarWeekRule("FirstFourDayWeek", 2);
        }

        /**
         * Indicates that the first week of the year begins on the first occurrence of the designated first day of the week on or after the first day of the year. The value is 1.
         * @access public
         * @return \System\Globalization\CalendarWeekRule
         */
        public static function firstFullWeek() 
        {
            return new CalendarWeekRule("FirstFullWeek", 1);
        }

    }
}
