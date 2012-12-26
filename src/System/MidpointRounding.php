<?php

namespace System {

    use \System\Enum as Enum;

    /**
     * Specifies how mathematical rounding methods should process a number that is midway between two numbers.
     * @access public
     * @name MidpointRounding
     */
    class MidpointRounding extends Enum {

        private function __construct($name,$value) {
            $this->_name = $name;
            $this->_value = $value;
        }

        /**
         * When a number is halfway between two others, it is rounded toward the nearest number that is away from zero.
         * @access public
         * @static
         * @return MidpointRounding
         */
        public static function awayFromZero() {
            return new MidpointRounding("AwayFromZero", PHP_ROUND_HALF_DOWN);
        }

        /**
         * When a number is halfway between two others, it is rounded toward the nearest even number.
         * @access public
         * @static
         * @return MidpointRounding
         */
        public static function toEven() {
            return new MidpointRounding("ToEven", PHP_ROUND_HALF_EVEN);
        }
    }
}
