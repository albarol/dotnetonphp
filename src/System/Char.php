<?php

namespace System {

    use \System\IComparable as IComparable;
    use \System\IConvertible as IConvertible;
    use \System\IEquatable as IEquatable;

    /**
     * Represents a Unicode character.
     * @access public
     * @name Char
     * @package System
     */
    final class Char implements IComparable, IConvertible, IEquatable {

        private $value;

        const MIN_VALUE = 0x0000;
        const MAX_VALUE = 0xFFFF;
        
        public function __construct() { }


        /**
         * Compares this instance to a specified \System\Char object and returns an indication of their relative values.
         * @access public
         * @param object $value A object to compare to this instance.
         * @return int A signed number indicating the relative values of this instance and the value parameter.
         */
        public function compareTo($value) {
            if ($this->value == $value):
                return 0;
            elseif($this->value < $value):
                return -1;
            elseif($this->value > $value):
                return 1;
            endif;
        }

        /**
         * Converts the specified Unicode code point into a UTF-16 encoded string.
         * @access public
         * @throws \System\ArgumentOutOfRangeException utf32 is not a valid 21-bit Unicode code point ranging from U+0 through U+10FFFF, excluding the surrogate pair range from U+D800 through U+DFFF.
         * @param int $utf32 A 21-bit Unicode code point.
         * @return string A string consisting of one Char object or a surrogate pair of Char objects equivalent to the code point specified by the utf32 parameter.
        */
        public static function convertFromUtf32($utf32) {
            throw new \System\NotImplementedException();
        }

        /**
         * Returns a value indicating whether this instance is equal to a specified \System\Char object.
         * @access public
         * @param object $obj A \System\Char value to compare to this instance.
         * @return bool true if obj has the same value as this instance; otherwise, false.
         */
        public function equals($other) {
            return $this->value() == $other;
        }


        /**
         * Represents the largest possible value of a Char. This field is constant.
         * @access public
         * @static
         * @final
         * @return \System\Char The value of this constant is hexadecimal 0xFFFF
         */
        public static final function maxValue() {
            $obj = new Char;
            $obj->value(self::MAX_VALUE);
            return $obj;
        }

        /**
         * Represents the smallest possible value of a Char. This field is constant.
         * @access public
         * @static
         * @final
         * @return \System\Char The value of this constant is hexadecimal 0x00.
         */
        public static final function minValue() {
            $obj = new Char;
            $obj->value(self::MIN_VALUE);
            return $obj;
        }

        /**
         * Get or set char value
         * @access public
         * @param char $value set char value
         * @return char char value
        */
        public function value($value=null) {
            if (is_null($value)):
                return $this->value;
            endif;
            if($value >= self::MIN_VALUE && $value <= self::MAX_VALUE):
                $this->value = $value;
            endif;
            return $this->value; 
        }

        

        public function getTypeCode() {
            return TypeCode::char();
        }

        public function toBoolean($provider) {

        }

        public function toByte($provider) {

        }

        public function toChar($provider) {

        }

        public function toDateTime($provider) {

        }

        public function toDecimal($provider) {

        }

        public function toDouble($provider) {

        }

        public function toInt16($provider) {

        }

        public function toInt32($provider) {

        }

        public function toInt64($provider)
        {

        }

        public function toSByte($provider)
        {

        }

        public function toSingle($provider)
        {

        }

        public function toType($conversionType, $provider)
        {

        }

        public function toUInt16($provider)
        {

        }

        public function toUInt32($provider)
        {

        }

        public function toUInt64($provider)
        {

        }
    }
}
