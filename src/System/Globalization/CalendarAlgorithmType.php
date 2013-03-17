<?php

namespace System\Globalization
{

    use System\Enum as Enum;

    /**
     * Specifies whether a calendar is solar-based, lunar-based, or lunisolar-based.
     * @access public
     * @name CalendarAlgorithmType
     * @package System
     * @subpackage Globalization
     */
    class CalendarAlgorithmType extends Enum 
    {
        private function __construct($name, $value) 
        {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * A lunar-based calendar.
         * @access public
         * @return \System\Globalization\CalendarAlgorithmType
         */
        public static function lunarCalendar() 
        {
            return new CalendarWeekRule("LunarCalendar", 2);
        }

        /**
         * A lunisolar-based calendar.
         * @access public
         * @return \System\Globalization\CalendarAlgorithmType
         */
        public static function lunisolarCalendar() 
        {
            return new CalendarWeekRule("LunisolarCalendar", 3);
        }

        /**
         * A solar-based calendar.
         * @access public
         * @return \System\Globalization\CalendarAlgorithmType
         */
        public static function solarCalendar() 
        {
            return new CalendarWeekRule("SolarCalendar", 1);
        }

        /**
        * An unknown calendar basis.
        * @access public
        * @return \System\Globalization\CalendarAlgorithmType
        */
       public static function unknown() 
       {
           return new CalendarWeekRule("Unknown", 0);
       }

    }
}
