<?php

namespace System { 

    use \System\Enum as Enum;

    /**
     * Specifies the type of an object.
     * @access public
     * @name TypeCode
     * @package System
     */
    class TypeCode extends Enum {

        /**
         * Constructor
         * @access private
         * @param string $name Name of element
         * @param int $value Value of element
         */
        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * A simple type representing Boolean values of true or false.
         * @access public
         * @static
         * @return \System\TypeCode Boolean TypeCode
         */
        public static function boolean() {
            return new TypeCode("Boolean", 3);
        }

        /**
         * An integral type representing unsigned 8-bit integers with values between 0 and 255.
         * @access public
         * @static
         * @return \System\TypeCode Byte TypeCode
         */
        public static function byte() {
            return new TypeCode("Byte", 6);
        }

        /**
         * An integral type representing unsigned 16-bit integers with values between 0 and 65535. The set of possible values for the System.TypeCode.Char type corresponds to the Unicode character set.
         * @access public
         * @static
         * @return \System\TypeCode Char TypeCode
         */
        public static function char() {
            return new TypeCode("Char", 4);
        }

        /**
         * A type representing a date and time value.
         * @access public
         * @static
         * @return \System\TypeCode DateTime TypeCode
         */
        public static function dateTime() {
            return new TypeCode("DateTime", 16);
        }

        /**
         * A database null (column) value.
         * @access public
         * @static
         * @return \System\TypeCode DbNull TypeCode
         */
        public static function dbNull() {
            return new TypeCode("DBNull", 2);
        }

        /**
         * A simple type representing values ranging from 1.0 x 10 -28 to approximately 7.9 x 10 28 with 28-29 significant digits.
         * @access public
         * @static
         * @return \System\TypeCode Boolean TypeCode
         */
        public static function decimal() {
            return new TypeCode("Decimal", 15);
        }

        /**
         * A floating point type representing values ranging from approximately 5.0 x 10 -324 to 1.7 x 10 308 with a precision of 15-16 digits.
         * @access public
         * @static
         * @return \System\TypeCode Boolean TypeCode
         */
        public static function double() {
            return new TypeCode("Double", 14);
        }

        /**
         * An integral type representing signed 16-bit integers with values between -32768 and 32767.
         * @access public
         * @static
         * @return \System\TypeCode Int16 TypeCode
         */
        public static function int16() {
            return new TypeCode("Int16", 7);
        }

        /**
         * An integral type representing signed 32-bit integers with values between -2147483648 and 2147483647.
         * @access public
         * @static
         * @return \System\TypeCode Int32 TypeCode
         */
        public static function int32() {
            return new TypeCode("Int32", 9);
        }

        /**
         * An integral type representing signed 64-bit integers with values between -92233720368548 and 92233720368548.
         * @access public
         * @static
         * @return \System\TypeCode Int64 TypeCode
         */
        public static function int64() {
            return new TypeCode("Int64", 11);
        }

        /**
         * A null reference. 
         * @access public
         * @return \System\TypeCode Null TypeCode
        */
        public static function nullable() {
            return new TypeCode("Null", 18);
        }

        /**
         * A general type representing any reference or value type not explicitly represented by another TypeCode.
         * @access public
         * @static
         * @return \System\TypeCode Object TypeCode
         */
        public static function object() {
            return new TypeCode("Object", 1);
        }

        /**
         * An integral type representing signed 8-bit integers with values between -128 and 127.
         * @access public
         * @static
         * @return \System\TypeCode SByte TypeCode
         */
        public static function sByte() {
            return new TypeCode("SByte", 5);
        }

        /**
         * A floating point type representing values ranging from approximately 1.5 x 10 -45 to 3.4 x 10 38 with a precision of 7 digits.
         * @access public
         * @static
         * @return \System\TypeCode Single TypeCode
         */
        public static function single() {
            return new TypeCode("Single", 13);
        }

        /**
         * A sealed class type representing Unicode character strings.
         * @access public
         * @static
         * @return \System\TypeCode String TypeCode
         */
        public static function string() {
            return new TypeCode("String", 18);
        }

        /**
         * An integral type representing unsigned 16-bit integers with values between 0 and 65535.
         * @access public
         * @static
         * @return \System\TypeCode UInt16 TypeCode
         */
        public static function uInt16() {
            return new TypeCode("UInt16", 8);
        }

        /**
         * An integral type representing unsigned 32-bit integers with values between 0 and 4294967295.
         * @access public
         * @static
         * @return \System\TypeCode UInt32 TypeCode
         */
        public static function uInt32() {
            return new TypeCode("UInt32", 10);
        }

        /**
         * An integral type representing unsigned 64-bit integers with values between 0 and 18446744073709551615.
         * @access public
         * @static
         * @return \System\TypeCode UInt64 TypeCode
         */
        public static function uInt64() {
            return new TypeCode("UInt64", 12);
        }
    }
}
