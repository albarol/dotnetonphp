<?php

namespace System\Xml {

    use \System\Enum as Enum;


    /**
     * Specifies how white space is handled.
     * @access public
     * @name WhitespaceHandling
     * @package System
     * @subpackage Xml
     */
    class WhitespaceHandling extends Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Return Whitespace and SignificantWhitespace nodes. This is the default.
         * @access public
         * @static
         * @return WhitespaceHandling
         */
        public static function all() {
            return new WhitespaceHandling("ALL", 0);
        }

        /**
         * Return no Whitespace and no SignificantWhitespace nodes.
         * @access public
         * @static
         * @return WhitespaceHandling
         */
        public static function none() {
            return new WhitespaceHandling("NONE", 1);
        }

        /**
         * Return no Whitespace and no SignificantWhitespace nodes.
         * @access public
         * @static
         * @return WhitespaceHandling
         */
        public static function significant() {
            return new WhitespaceHandling("SIGNIFICANT", 2);
        }

    }
}