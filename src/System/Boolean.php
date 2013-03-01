<?php

namespace System {

    use \System\ArgumentNullException as ArgumentNullException;
    use \System\IComparable as IComparable;
    use \System\IConvertible as IConvertible;
    use \System\IEquatable as IEquatable;
    use \System\FormatException as FormatException;
    use \System\TypeCode as TypeCode;

    /**
     * Represents a Boolean value.
     * @package System
     * @access public
     * @name Boolean
     * @final
     */
    final class Boolean implements IComparable, IConvertible, IEquatable {

        private $value;
        private $readOnly;

        public function  __construct($value=false) {
            $this->value($value);
        }

        /**
         * Represents the Boolean value false as a string. This field is read-only.
         * @static
         * @access public
         */
        const FalseString = "False";

        /**
         * Represents the Boolean value true as a string. This field is read-only.
         * @static
         * @access public
         */
        const TrueString = "True";

        /**
         * Compares this instance to a specified \System\Boolean object and returns an indication of their relative values.
         * @access public
         * @param bool $value A bool object to compare to this instance.
         * @return int A signed integer that indicates the relative values of this instance and value.Return Value Condition Less than zero This instance is false and value is true. Zero This instance and value are equal (either both are true or both are false). Greater than zero This instance is true and value is false.
         */
        public function compareTo($value) {
            if (!is_bool($value)) {
                return;
            }
            if ($this->value == $value):
                return 0;
            elseif($this->value && !$value):
                return 1;
            elseif(!$this->value && $value):
                return -1;
            endif;
        }


        /**
         * Returns a value indicating whether this instance is equal to a specified \System\Boolean object.
         * @access public
         * @param object $obj A \System\Boolean value to compare to this instance.
         * @return bool true if obj has the same value as this instance; otherwise, false.
         */
        public function equals($obj) {
            if($obj instanceof Boolean) return $this->equals($obj->value);
            if(!is_bool($obj) || $this->value != $obj) return false;
            return true;
        }


        /**
         * Returns the hash code for this instance.
         * @access public
         * @return int A hash code for the current \System\Boolean.
         */
        public function getHashCode() {
            return ($this->value) ? 1 : 0;
        }


        /**
         * Returns the System.TypeCode for value type System.Boolean.
         * @access public
         * @return \System\TypeCode The enumerated constant, System.TypeCode.Boolean.
         */
        public function getTypeCode() {
            return TypeCode::boolean();
        }


        /**
         * Converts the specified string representation of a logical value to its System.Boolean equivalent.
         * @access public
         * @throws \System\ArgumentNullException value is null.
         * @throws \System\FormatException value is not equivalent to \System\Boolean::TrueString or \System\Boolean::FalseString.
         * @param string $value A string containing the value to convert.
         * @return bool true if value is equivalent to System.Boolean.TrueString; otherwise, false.
         */
        public static function parse($value) {
            if(is_null($value)):
                throw new ArgumentNullException("value is null.");
            elseif($value == self::TrueString):
                return new Boolean(true);
            elseif($value == self::FalseString):
                return new Boolean();
            endif;
            throw new FormatException("value is not equivalent to System.Boolean.TrueString or System.Boolean.FalseString.");
        }

        /**
         * Returns a string that represents the current object.
         * @access public
         * @return string A string that represents the current object.
         */
        public function toString($provider=null) {
            return ($this->value) ? self::TrueString : self::FalseString;
        }

        /*
         * Magic method to convert value to string
        */
        public function __toString() {
            return $this->toString();
        }


        /**
         * Converts the specified string representation of a logical value to its System.Boolean equivalent. A return value indicates whether the conversion succeeded or failed.
         * @static
         * @access public
         * @param String $value A string containing the value to convert.
         * @param bool $result When this method returns, if the conversion succeeded, contains true if value is equivalent to System.Boolean.TrueString or false if value is equivalent to System.Boolean.FalseString. If the conversion failed, contains false. The conversion fails if value is null or is not equivalent to either System.Boolean.TrueString or System.Boolean.FalseString. This parameter is passed uninitialized.
         * @return bool true if value was converted successfully; otherwise, false.
         */
        public static function tryParse($value, &$result) {
            try {
                $result = self::parse($value)->value;
                return true;
            } catch(\Exception $e) {
                return false;
            }
        }

        /**
         * Get or set bool value
         * @access public
         * @param bool $value set bool value
         * @return bool bool value
        */
        public function value($value=null) {
            if(is_bool($value)) {
                $this->value = $value;
            }
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
    }
}
