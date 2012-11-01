<?php

namespace System {

    use \System\ArgumentNullException as ArgumentNullException;
    use \System\FormatException as FormatException;

    /**
     * Converts a base data type to another base data type.
     * @access public
     * @package System
     * @name Convert
     */
    class Convert {

        /**
         * Returns an System.Object with the specified System.Type and whose value is equivalent to the specified object.
         * @access public
         * @static
         * @throws ArgumentNullException
         * @param $value An System.Object that implements the System.IConvertible interface.
         * @param $conversionType A System.Type.
         * @return void An object whose System.Type is conversionType and whose value is equivalent to value.
         */
        public static function changeType($value, $conversionType) {
            if($conversionType == null)
                throw new ArgumentNullException("conversionType is null");
        }

        
        /**
         * Converts a subset of a Unicode character array, which encodes binary data as base 64 digits, to an equivalent 8-bit unsigned integer array. Parameters specify the subset in the input array and the number of elements to convert.
         * @static
         * @access public
         * @param $inArray A Unicode character array.
         * @param $offset A position within inArray.
         * @param $length The number of elements in inArray to convert.
         * @return array An array of 8-bit unsigned integers equivalent to length elements at position offset in inArray.
         */
        public static function fromBase64CharArray($inArray, $offset, $length){ }

        /**
         * Converts the specified System.String, which encodes binary data as base 64 digits, to an equivalent 8-bit unsigned integer array.
         * @static
         * @access public
         * @throws System.ArgumentNullException: s is null.
         * @throws System.FormatException: The length of s, ignoring white space characters, is not zero or a multiple of 4.
         * @param String $s A System.String.
         * @return Byte An array of 8-bit unsigned integers equivalent to s.
         */
        public static function fromBase64String($s){
            if($s == null) throw new ArgumentNullException("s is null.");
            if(sizeof($s) > 0 && sizeof($s) % 4 != 0) throw new FormatException("The length of s, ignoring white space characters, is not zero or a multiple of 4.");
        }

        /**
         * Returns the System.TypeCode for the specified object.
         * @access public
         * @param object $value An System.Object that implements the System.IConvertible interface.
         * @return int The System.TypeCode for value, or System.TypeCode.Empty if value is null.
         */
        public static function getTypeCode($value) { }
    }
}
