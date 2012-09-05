<?php

namespace System;

require_once("IConvertible.php");
require_once("IComparable.php");

/**
 * Provides the base class for enumerations.
 * @access public
 * @package System
 */
abstract class Enum implements IConvertible, IComparable {

    protected $name;
    protected $value;

    public function name() {
        return $this->name;
    }

    public function value() {
        return $this->value;
    }

    public function  __toString() {
        return $this->name;
    }

    public function compareTo($obj) {

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
