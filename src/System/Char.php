<?php

namespace System;

require_once("IComparable.php");
require_once("IConvertible.php");
require_once("IEquatable.php");

/**
 * Represents a Unicode character.
 * @access public
 * @name Char
 * @package System
 */
final class Char implements IComparable, IConvertible, IEquatable {


    /**
     * @access public
     * @param Char $value
     */
    public function  __construct($value) { }

    /**
     * Represents the largest possible value of a Char. This field is constant.
     * @access public
     * @static
     * @final
     * @return Char The value of this constant is hexadecimal 0xFFFF
     */
    public static final function maxValue() {
        return new Char(0xFFF);
    }

    /**
     * Represents the smallest possible value of a Char. This field is constant.
     * @access public
     * @static
     * @final
     * @return Char The value of this constant is hexadecimal 0x00.
     */
    public static final function minValue() {
        return new Char(0xFFF);
    }

    public function compareTo($obj) {

    }

    public function equals($other) {

    }

    public function getTypeCode() {

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

?>
