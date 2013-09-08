<?php

namespace System {

    use \System\Enum as Enum;

    /**
     * Specifies the day of the week.
     * @access public
     * @name DayOfWeek
     * @package System
     */
    class DayOfWeek extends Enum 
    {

        private function __construct($name, $value) 
        {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Indicates Sunday.
         * @access public
         * @return \System\DayOfWeek
         */
        public static function sunday() 
        {
            return new DayOfWeek("Sunday", 0);
        }

        /**
         * Indicates Monday.
         * @access public
         * @return \System\DayOfWeek
         */
        public static function monday() {
            return new DayOfWeek("Monday", 1);
        }

        /**
         * Indicates Tuesday.
         * @access public
         * @return \System\DayOfWeek
         */
        public static function tuesday() {
            return new DayOfWeek("Tuesday", 2);
        }

        /**
         * Indicates Wednesday.
         * @access public
         * @return \System\DayOfWeek
         */
        public static function wednesday() {
            return new DayOfWeek("Wednesday", 3);
        }

        /**
         * Indicates Thursday.
         * @access public
         * @return \System\DayOfWeek
         */
        public static function thursday() {
            return new DayOfWeek("Thursday", 4);
        }

        /**
         * Indicates Friday.
         * @access public
         * @return \System\DayOfWeek
         */
        public static function friday() {
            return new DayOfWeek("Friday", 5);
        }

        /**
         * Indicates Saturday.
         * @access public
         * @return \System\DayOfWeek
         */
        public static function saturday() {
            return new DayOfWeek("Saturday", 6);
        }
    }
}
