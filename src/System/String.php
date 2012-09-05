<?php

namespace System;

require_once('Object.php');
require_once('ICloneable.php');
require_once('IConvertible.php');
require_once('IComparable.php');
require_once(dirname(__FILE__) . "/collections/IEnumerable.php");
require_once('IEquatable.php');
require_once('ArgumentNullException.php');
require_once('ArgumentOutOfRangeException.php');
require_once('TypeCode.php');
require_once('Char.php');


/**
 * Represents text as a series of Unicode characters.
 * @access public
 * @package System
 * @name String
 * @final
 */
final class String extends Object implements ICloneable, IConvertible, IComparable, \System\Collections\IEnumerable, IEquatable {

    /**
     * Method to construct object
     * @param String $value
     * @access public
     */
    public function __construct($value) {
        $this->properties['value'] = array('value' => '', 'readOnly' => false); //initialize properties
        if (is_a($value, "String")) {
            $this->value = $value->value;
        } else {
            $this->value = $value;
        }
    }

    /**
     * Represents the empty string. This field is read-only.
     *
     * @static
     * @access public
     *
     * @return String The value of this field is the zero-length string, ""
     */

    public static function getEmpty() {
        return new String("");
    }

    /**
     * Gets the number of characters in this instance.
     *
     * @access public
     * @return Int32 The number of characters in this instance.
     */

    public function length() {
        return mb_strlen($this->value, 'utf8');
    }

    /**
     * Gets the character at a specified character position in this instance. 
     *
     * @access public
     *
     * @param Int32 $index A character position in this instance.
     *
     * @return Char This property returns the Char at the position specified by the index parameter. However, a Unicode character might be represented by more than one Char. Use the System.Globalization.StringInfo class to work with each Unicode character instead of each Char.
     */
    
    public function chars($index) {
        if ($index < 0) throw new ArgumentOutOfRangeException ("startIndex is less than zero.");
        if ($index > $this->length()) throw new ArgumentOutOfRangeException("startIndex specifies a position that is not within this string.");
        return new Char($this->value[$index]);
    }


    /**
     * Returns a copy of this System.String converted to uppercase, using the casing
     * rules of the current culture.
     *
     * @access public
     *
     * @return String A System.String in uppercase.
     */

    public function toUpper() {
        return new String(strtoupper($this->value));
    }

    /**
     * Returns a copy of this System.String converted to lowercase, using the casing
     * rules of the current culture.
     *
     * @access public
     * 
     * @return String A System.String in lowercase.
     */

    public function toLower() {
        return new String(strtolower($this->value));
    }

    /**
     * Copies the characters in this instance to a Unicode character array.
     *
     * @access public
     *
     * @return Char A Unicode character array whose elements are the individual characters of this instance. If this instance is an empty string, the returned array is empty and has a zero length.
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
     * @static
     * @access public
     * @param String $string A String reference.
     * @return Boolean true if the value parameter is a null reference or an empty string (""); otherwise, false.
     */
    public static function isNullOrEmpty($string) {
        return is_null($string) || empty($string);
    }

    /**
     * Concatenates two specified instances of String. 
     *
     * @access public
     * @static
     *
     * @param String $str0 The first String.
     * @param String $str1 The second String.
     *
     * @return String The concatenation of str0 and str1.
     */

    public static function concat($str0, $str1) {
        return new String($str0 . $str1);
    }

    /**
     * Reports the index of the first occurrence of a String, or one or more characters, within this string.
     *
     * @access public
     * 
     * @param Char $value A Unicode character to seek.
     *
     * @return Int32 The index position of value if that character is found, or -1 if it is not.
     */

    public function indexOf($value) {
        if (strlen($value) > 1)
            throw Exception("Can't have more than one character");
        $result = strpos($this->value, $value);
        if (!$result)
            return -1;
        return $result;
    }

    /**
     * Returns a value indicating whether the specified System.String object occurs within this string.
     *
     * @access public
     *
     * @param String $value The System.String object to seek.
     *
     * @return Boolean true if the value parameter occurs within this string, or if value is the empty string (""); otherwise, false.
     */

    public function contains($value) {
        $result = strpos($this->value, $value);
        if (!$result) return false;
        return true;
    }

    /**
     *  Replaces all occurrences of a specified Unicode character or String in this instance, with another specified Unicode character or String. 
     *
     * @access public
     *
     * @param String $oldValue A System.String to be replaced.
     * @param String $newValue A System.String to replace all occurrences of oldValue.
     *
     * @return String A System.String equivalent to this instance but with all instances of oldValue replaced with newValue.
     */
    public function replace($oldValue, $newValue) {
        if ($oldValue == null)
            throw new ArgumentNullException("value is null.");
        if (String::isNullOrEmpty($oldValue))
            throw new ArgumentException("value is empty.");

        return new String(str_replace($oldValue, $newValue, $this->value));
    }

    /**
     * Returns a reference to this instance of System.String.
     * 
     * @return String This instance of String.
     */
    public function cloneObject() {
        return clone $this;
    }

    /**
     * Removes all leading and trailing white-space characters from the current System.String object.
     *
     * @access public
     *
     * @return String The string that remains after all white-space characters are removed from the start and end of the current System.String object.
     */
    public function trim() {
        return new String(trim($this->value));
    }

    /**
     * Deletes all the characters from this string beginning at a specified position and continuing through the last position.
     *
     * @access public
     *
     * @param Int32 startIndex The zero-based position to begin deleting characters.
     *
     * @return String A new System.String object that is equivalent to this string less the removed characters.
     */
    public function remove($startIndex) {
        if ($startIndex < 0) throw new ArgumentOutOfRangeException ("startIndex is less than zero.");
        if ($startIndex > $this->length()) throw new ArgumentOutOfRangeException("startIndex specifies a position that is not within this string.");
        return new String(substr($this->value, 0, $startIndex));
    }

    public function getTypeCode() {
        /** @noinspection PhpUndefinedClassInspection */
        return Code::string();
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

    public function compareTo($obj) {

    }

    public function getEnumerator() {

    }

    function equals($other)
    {
        // TODO: Implement equals() method.
    }
}
?>
