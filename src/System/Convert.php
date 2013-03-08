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
         * Converts a subset of a Unicode character array, which encodes binary data as base 64 digits, to an equivalent 8-bit unsigned integer array. Parameters specify the subset in the input array and the number of elements to convert.
         * @static
         * @access public
         * @throws \System\ArgumentOutOfRangeException offset or length is less than zero -or- offset plus length indicates a position not within inArray.
         * @throws \System\FormatException The length of inArray, ignoring white space characters, is not zero or multiple of 4 -or- The format of inArray is invalid.
         * @param $inArray A Unicode character array.
         * @param $offset A position within inArray.
         * @param $length The number of elements in inArray to convert.
         * @return array An array of 8-bit unsigned integers equivalent to length elements at position offset in inArray.
         */
        public static function fromBase64CharArray($inArray = array(), $offset = 0, $length = null) { 
            if ($offset < 0 || $length < 0):
                throw new ArgumentOutOfRangeException("offset or length is less than zero -or- offset plus length indicates a position not within inArray.");
            endif;

            if(($offset + $length) > sizeof($inArray)):
                throw new ArgumentOutOfRangeException("offset or length is less than zero -or- offset plus length indicates a position not within inArray.");
            endif;

            if (is_null($length)):
                $length = sizeof($inArray) - $offset;
            endif;

            $inArray = array_slice($inArray, $offset, $length);
            $result = Convert::fromBase64String(implode($inArray));

            return $result;
        }

        /**
         * Converts the specified System.String, which encodes binary data as base 64 digits, to an equivalent 8-bit unsigned integer array.
         * @static
         * @access public
         * @throws \System\ArgumentNullException s is null.
         * @throws \System\FormatException: The length of s, ignoring white space characters, is not zero or a multiple of 4.
         * @param string $s A string.
         * @return array An array of 8-bit unsigned integers equivalent to s.
         */
        public static function fromBase64String($s){
            if($s == null):
                throw new ArgumentNullException("s is null.");
            endif;
            
            $result = base64_decode($s, true);
            
            if ($result === FALSE):
                throw new FormatException("The length of s, ignoring white space characters, is not zero or a multiple of 4.");
            endif;


            $out = array();
            for($letter=0; $letter < strlen($result); $letter++) {
                $dec = ord(substr($result, $letter, 1));
                $bin = '';
                
                for($i=7; $i>=0; $i--) {
                    if ($dec >= pow(2, $i) ) {
                        $bin .= "1";
                        $dec -= pow(2, $i);
                    } else {
                        $bin .= "0";
                    }
                }
                
                $out[$letter] = $bin;
            }

            return $out;
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
