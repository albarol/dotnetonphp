<?php

namespace System {

    /**
     * Represents a null value.
     * @access public
     * @package System
     * @name DbNull
     */
    class DbNull {

        private static $instance;

        private function __construct() { }

        /**
         * Represents the sole instance of the DBNull class.
         * @static
         * @access public
         * @return \System\DbNull DBNull is a singleton class, which means only this instance of this class can exist.
        */
        public static function value() {
            if (is_null(self::$instance)):
                self::$instance = new DbNull();
            endif;
            return self::$instance;
        }
    }
}
