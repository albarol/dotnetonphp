<?php

namespace System {

    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\Char as Char;
    use \System\ICloneable as ICloneable;
    use \System\IConvertible as IConvertible;
    use \System\IComparable as IComparable;
    use \System\IEquatable as IEquatable;
    use \System\TypeCode as TypeCode;

    use \System\Collections\IEnumerable as IEnumerable;

    /**
     * Represents text as a series of Unicode characters.
     * @access public
     * @package System
     * @name String
     * @final
     */
    final class String  implements ICloneable, IConvertible, IComparable, IEnumerable, IEquatable {

        private $value;
        private $readOnly;

        /**
         * Initializes a new instance of the String class.
         * @access public
         */
        public function __construct($value) { 
            $this->value = "".$value;
        }

        /**
         * Gets the character at a specified character position in this instance. 
         * @access public
         * @throws \System\ArgumentOutOfRangeException startIndex is less than zero. -or- startIndex specifies a position that is not within this string.
         * @param int $index A character position in this instance.
         * @return string This property returns the Char at the position specified by the index parameter. However, a Unicode character might be represented by more than one Char. Use the System.Globalization.StringInfo class to work with each Unicode character instead of each Char.
         */
        public function chars($index) {
            if ($index < 0):
                throw new ArgumentOutOfRangeException ("startIndex is less than zero.");
            elseif ($index > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex specifies a position that is not within this string.");
            endif;
            return $this->value[$index];
        }

        /**
         * Concatenates two specified instances of String. 
         * @access public
         * @static
         * @param string $str0 The first String.
         * @param string $str1 The second String.
         * @return \System\String The concatenation of str0 and str1.
         */
        public static function concat($str0, $str1) {
            return new String($str0 . $str1);
        }

        /**
         * Returns a value indicating whether the specified System.String object occurs within this string.
         * @access public
         * @param string $value The System.String object to seek.
         * @return bool true if the value parameter occurs within this string, or if value is the empty string (""); otherwise, false.
        */
        public function contains($value) {
            return $this->indexOf($value) > -1;
        }

        /**
         * Compares two specified String objects by evaluating the numeric values of the corresponding Char objects in each string.
         * @access public
         * @static
         * @param $strA The first String.
         * @param $strB The second String.
         * @return int An integer indicating the lexical relationship between the two comparands.
        */
        public static function compareOrdinal($strA, $strB) {
            $first = ($strA instanceof String) ? $strA->value() : $strA;
            $second = ($strB instanceof String) ? $strB->value() : $strB;
            return strcmp($first, $second);
        }

        /**
         * Compares this instance with a specified String object.
         * @access public
         * @param $strB A String.
         * @return int An integer indicating the lexical relationship between the two comparands.
        */
        public function compareTo($strB) {
            $first = ($strB instanceof String) ? $strB->value() : $strB;
            return strcmp($this->value, $first);
        }

        /**
         * Creates a new instance of String with the same value as a specified String.
         * @access public
         * @static
         * @param $str The String to copy.
         * @return \System\String A new String with the same value as str.
        */
        public static function copy(String $str) {
            return clone $str;
        }

        /**
         * Returns a reference to this instance of System.String.
         * @access public
         * @return \System\String This instance of String.
         */
        public function cloneObject() {
            return clone $this;
        }

        public function equals($other) {
            if($other instanceof String):
                return $this->value() == $other->value();
            endif;
            return false;
        }

        /**
         * Represents the empty string. This field is read-only.
         * @static
         * @access public
         * @return \System\String The value of this field is the zero-length string, ""
         */

        public static function getEmpty() {
            return new String("");
        }

        public function getTypeCode() {
            return TypeCode::string();
        }

        /**
         * Gets the number of characters in this instance.
         * @access public
         * @return int The number of characters in this instance.
         */
        public function length() {
            return mb_strlen($this->value, 'utf8');
        }


        /**
         * Returns a copy of this System.String converted to uppercase, using the casing rules of the current culture.
         * @access public
         * @return \System\String A System.String in uppercase.
         */
        public function toUpper() {
            return new String(strtoupper($this->value));
        }

        /**
         * Returns a copy of this \System\String converted to lowercase, using the casing rules of the current culture.
         * @access public
         * @return \System\String A \System\String in lowercase.
         */
        public function toLower() {
            return new String(strtolower($this->value));
        }

        /**
         * Copies the characters in this instance to a Unicode character array.
         * @access public
         * @return array A Unicode character array whose elements are the individual characters of this instance. If this instance is an empty string, the returned array is empty and has a zero length.
         */
        public function toCharArray() {
            $array = array();
            for ($i = 0; $i < $this->length(); $i++) {
                $array[] = substr($this->value, $i, 1);
            }
            return $array;
        }
        
        /**
         * 	Indicates whether the specified String object is a null reference or an Empty string.
         * @access public
         * @static
         * @param string $string A String reference.
         * @return bool true if the value parameter is a null reference or an empty string (""); otherwise, false.
         */
        public static function isNullOrEmpty($string) {
            if($string instanceof String):
                return self::isNullOrEmpty($string->value());
            endif;                    
            return is_null($string) || empty($string);
        }

        

        /**
         * Reports the index of the first occurrence of a String, or one or more characters, within this string.
         * @access public
         * @param string $value A Unicode character to seek.
         * @return int The index position of value if that character is found, or -1 if it is not.
         */
        public function indexOf($value) {
            if($value instanceof String):
                return $this->indexOf($value->value());
            endif;
            $result = strpos($this->value, $value);
            return $result === false ? -1 : $result;
        }

        

        /**
         * Replaces all occurrences of a specified Unicode character or String in this instance, with another specified Unicode character or String. 
         * @access public
         * @throws \System\ArgumentNullException value is null.
         * @throws \System\ArgumentException value is empty.
         * @param string $oldValue A \System\String to be replaced.
         * @param string $newValue A \System\String to replace all occurrences of oldValue.
         * @return \System\String A System.String equivalent to this instance but with all instances of oldValue replaced with newValue.
         */
        public function replace($oldValue, $newValue) {
            if ($oldValue == null):
                throw new ArgumentNullException("value is null.");
            elseif (self::isNullOrEmpty($oldValue)):
                throw new ArgumentException("value is empty.");
            endif;
            return new String(str_replace($oldValue, $newValue, $this->value()));
        }        

        /**
         * Removes all leading and trailing white-space characters from the current System.String object.
         * @access public
         * @return \System\String The string that remains after all white-space characters are removed from the start and end of the current System.String object.
         */
        public function trim() {
            return new String(trim($this->value));
        }

        /**
         * Deletes all the characters from this string beginning at a specified position and continuing through the last position.
         * @access public
         * @param int startIndex The zero-based position to begin deleting characters.
         * @return \System\String A new System.String object that is equivalent to this string less the removed characters.
         */
        public function remove($startIndex) {
            if ($startIndex < 0):
                throw new ArgumentOutOfRangeException ("startIndex is less than zero.");
            elseif ($startIndex > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex specifies a position that is not within this string.");
            endif;
            return new String(substr($this->value, 0, $startIndex));
        }

        /**
         * Get or set string value
         * @access public
         * @param string $value string value
         * @return string string value
        */
        public function value($value=null) {
            if($value instanceof String):
                $this->value = $value->value();
            elseif(!is_null($value)):
                $this->value = "".$value;
            endif;
            return $this->value;
        }

        public function __toString() {
            return $this->value;
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

        public function toInt64($provider) {

        }

        public function toSByte($provider) {

        }

        public function toSingle($provider) {

        }

        public function toType($conversionType, $provider) {

        }

        public function toUInt16($provider) {

        }

        public function toUInt32($provider) {

        }

        public function toUInt64($provider) {

        }

        public function getEnumerator() {

        }
   }
}
