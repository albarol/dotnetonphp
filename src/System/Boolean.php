<?php

namespace System;

require_once("Object.php");
require_once("Int32.php");
require_once("String.php");
require_once("ArgumentNullException.php");
require_once("IComparable.php");
require_once("FormatException.php");
require_once("IConvertible.php");
require_once("IEquatable.php");
require_once("TypeCode.php");


/**
 * Represents a Boolean value.
 * @package System
 * @access public
 * @name Boolean
 * @final
 */
final class Boolean extends Object implements IComparable, IConvertible, IEquatable {

    public function  __construct($value=false) {
        if(is_bool($value))
            $this->properties['value'] = array('value' => $value, 'readOnly' => false);
    }

    /**
     * Represents the Boolean value false as a string. This field is read-only.
     * @static
     * @access public
     * @property-read
     */
    const FalseString = "False";

    /**
     * Represents the Boolean value true as a string. This field is read-only.
     * @static
     * @access public
     * @property-read
     */
    const TrueString = "True";

    /**
     * Compares this instance to a specified System.Boolean object and returns an indication of their relative values.
     * @access public
     * @param bool $value A System.Boolean object to compare to this instance.
     * @return int A signed integer that indicates the relative values of this instance and value.Return Value Condition Less than zero This instance is false and value is true. Zero This instance and value are equal (either both are true or both are false). Greater than zero This instance is true and value is false.
     */
    public function compareTo($value) {
        if(is_bool($value)) {
            if($this->value == $value) return 0;
            if($this->value && !$value) return 1;
            if(!$this->value && $value) return -1;
        }
    }


    /**
     * Returns a value indicating whether this instance is equal to a specified System.Boolean object.
     * @access public
     * @param Object $obj A System.Boolean value to compare to this instance.
     * @return Boolean true if obj has the same value as this instance; otherwise, false.
     */
    public function equals($obj) {
        if($obj instanceof Boolean) return $this->equals($obj->value);
        if(!is_bool($obj) || $this->value != $obj) return false;
        return true;
    }


    /**
     * Returns the hash code for this instance.
     * @access public
     * @return int A hash code for the current System.Boolean.
     */
    public function getHashCode() {
        if($this->value) return 1;
        return 0;
    }


    /**
     * Returns the System.TypeCode for value type System.Boolean.
     * @access public
     * @return Code The enumerated constant, System.TypeCode.Boolean.
     */
    public function getTypeCode() {
        return TypeCode::boolean();
    }


    /**
     * Converts the specified string representation of a logical value to its System.Boolean equivalent.
     * @access public
     * @param string $value A string containing the value to convert.
     * @return bool true if value is equivalent to System.Boolean.TrueString; otherwise, false.
     */
    public static function parse($value) {
        if(is_null($value)) throw new ArgumentNullException("value is null.");
        if($value == self::TrueString) return new Boolean(true);
        if($value == self::FalseString) return new Boolean();
        throw new FormatException("value is not equivalent to System.Boolean.TrueString or System.Boolean.FalseString.");
    }

    public function toString($provider=null) {
        if($this->value) return self::TrueString;
        return self::FalseString;
    }


    /**
     * Converts the specified string representation of a logical value to its System.Boolean equivalent. A return value indicates whether the conversion succeeded or failed.
     * @static
     * @access public
     * @param String $value A string containing the value to convert.
     * @param Boolean $result When this method returns, if the conversion succeeded, contains true if value is equivalent to System.Boolean.TrueString or false if value is equivalent to System.Boolean.FalseString. If the conversion failed, contains false. The conversion fails if value is null or is not equivalent to either System.Boolean.TrueString or System.Boolean.FalseString. This parameter is passed uninitialized.
     * @return Boolean true if value was converted successfully; otherwise, false.
     */
    public static function tryParse($value, &$result) {
        try {
            $result = self::parse($value)->value;
            return true;
        } catch(Exception $e) {
            return false;
        }
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
}

?>
