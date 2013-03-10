<?php

namespace System {
    
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\FormatException as FormatException;
    use \System\TypeCode as TypeCode;

    /**
     * Represents a 32-bit signed integer.
     * @access public
     * @final
     * @package System
     * @name Int32
     */
    final class Int32 {

        private $value;

        /**
         * Represents the largest possible value of an System.Int32. This field is constant.
         */
        const MaxValue = 2147483647;
        
        /**
         * Represents the smallest possible value of System.Int32. This field is constant.
         */
        const MinValue = -2147483647;

        public function __construct($value) { 
             if(is_null($value)):
                throw new ArgumentNullException("s is null.");
            endif;

            if(!is_int($value)):
                throw new FormatException("s is not in the correct format.");
            endif;

            if($value < self::MinValue):
                $value = self::MinValue;
            elseif($value > self::MaxValue):
                $value = self::MaxValue;
            endif;

            $this->value = $value;
        }
        
        /**
         * Represents the largest possible value of an Int32. This field is constant.
         * @access public
         * @static
         * @return \System\Int32 The value of this constant is 2,147,483,647; that is, hexadecimal 0x7FFFFFFF.
        */
        public static function maxValue() {
            return new Int32(self::MaxValue);
        }

        /**
         * Represents the smallest possible value of System.Int32. This field is constant.
         * @access public
         * @static
         * @return \System\Int32 The value of this constant is -2,147,483,648; that is, hexadecimal 0x80000000.
        */
        public static function minValue() {
            return new Int32(self::MinValue);
        }

        /**
         * Compares this instance to a specified 32-bit signed integer and returns an indication of their relative values.
         * @access public
         * @param int value An integer to compare.
         * @return bool A signed number indicating the relative values of this instance and value.
         */
        public function compareTo($obj) {
            if($obj instanceof Int32):
                return $this->compareTo($obj->value());
            endif;

            if($this->value < $obj):
                return -1;
            elseif($this->value > $obj):
                return 1;
            else:
                return 0;
            endif;
        }


        /**
         * Returns a value indicating whether this instance is equal to a specified System.Int32 value.
         * @access public
         * @param object $obj An System.Int32 value to compare to this instance.
         * @return bool true if obj has the same value as this instance; otherwise, false.
         */
        public function equals($obj) {
            if($obj instanceof Int32):
                return $this->equals($obj->value());
            endif;
            return is_int($obj) && $this->value == $obj;
        }


        /**
         * Returns the hash code for this instance.
         * @return int A 32-bit signed integer hash code.
         */
        public function getHashCode() {
            return $this->value;
        }


        /**
         * Returns the System.TypeCode for value type System.Int32.
         * @return \System\TypeCode The enumerated constant, System.TypeCode.Int32.
         */
        public function getTypeCode() {
            return TypeCode::int32();
        }

        /**
         * Converts the string representation of a number to its 32-bit signed integer equivalent.
         * @param string $ A string containing a number to convert.
         * @return \System\Int32 A 32-bit signed integer equivalent to the number contained in s.
         */
        public static function parse($s) {
            return new Int32($s);
        }

        /**
         * Converts the string representation of a number to its 32-bit signed integer equivalent. A return value indicates whether the conversion succeeded.
         * @param string $s A string containing a number to convert.
         * @param \System\Int32 result When this method returns, contains the 32-bit signed integer value equivalent to the number contained in s, if the conversion succeeded, or zero if the conversion failed
         * @return bool true if the conversion succeeded, otherwise false.
        */
        public static function tryParse($s) {
            try {
                return array(
                    'object' => self::parse($s),
                    'result' => true
                );
            } catch(\Exception $ex) {
                return array(
                    'object' => null,
                    'result' => false
                );
            }
        }

        /**
         * Converts the numeric value of this instance to its equivalent string representation.
         * @access public 
         * @return string The return value is formatted with the general format specifier ("G") and the NumberFormatInfo for the current culture.
        */
        public function toString() {
            return "".$this->value;
        }


        public function __toString() {
            return $this->toString();
        }

        /**
         * Get or set Int32 value
         * @access public
         * @param \System\Int32 $value set Int32 value
         * @return \System\Int32 value
        */
        public function value($value=null) {
            if (is_numeric($value)) {
                $this->value = $value;
            } else if ($value instanceof Int32) {
                $this->value = $value->value();
            }
            return $this->value;
        }
    }
}