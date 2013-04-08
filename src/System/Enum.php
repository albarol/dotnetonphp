<?php

namespace System { 

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

        /**
         * Compares the current instance with another object of the same type.
         *
         * @param $obj An object to compare with this instance.
         * @return int A 32-bit signed integer that indicates the relative order of the objects being compared. The return value has these meanings: Value Meaning Less than zero This instance is less than obj. Zero This instance is equal to obj. Greater than zero This instance is greater than obj.
         */
        public function compareTo($obj)
        {

        }

        /**
         * Returns the TypeCode for this instance.
         *
         * @access public
         * @return \System\TypeCode The enumerated constant that is the System.TypeCode of the class or value type that implements this interface.
         */
        public function getTypeCode() 
        {
            
        }


        /**
         * Converts the value of this instance to an equivalent Boolean value using the specified culture-specific formatting information.
         *
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Boolean A Boolean value equivalent to the value of this instance.
         */
        public function toBoolean(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 8-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Byte An 8-bit unsigned integer equivalent to the value of this instance.
         */
        public function toByte(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent Unicode character using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Char A Unicode character equivalent to the value of this instance.
         */
        public function toChar(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent System.DateAndTime using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\DateTime A System.DateTime instance equivalent to the value of this instance.
         */
        public function toDateTime(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent System.Decimal number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return Decimal A System.Decimal number equivalent to the value of this instance.
         */
        public function toDecimal(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent double-precision floating-point number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Double A double-precision floating-point number equivalent to the value of this instance.
         */
        public function toDouble(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 16-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int16 An 16-bit signed integer equivalent to the value of this instance.
         */
        public function toInt16(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 32-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int32 An 32-bit signed integer equivalent to the value of this instance.
         */
        public function toInt32(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 64-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int64 An 64-bit signed integer equivalent to the value of this instance.
         */
        public function toInt64(IFormatProvider $provider = null) 
        {
            
        }


        /**
         * Converts the value of this instance to an equivalent 8-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\SByte An 8-bit signed integer equivalent to the value of this instance.
         */
        public function toSByte(IFormatProvider $provider = null) 
        {
            
        }


        /**
         * Converts the value of this instance to an equivalent single-precision floating-point number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Single A single-precision floating-point number equivalent to the value of this instance.
         */
        public function toSingle(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an System.Object of the specified System.Type that has an equivalent value, using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\Type $conversionType The System.Type to which the value of this instance is converted.
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return Type An System.Object instance of type conversionType whose value is equivalent to the value of this instance.
         */
        public function toType(Type $conversionType, IFormatProvider $provider) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 16-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt16 An 16-bit unsigned integer equivalent to the value of this instance.
         */
        public function toUInt16(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 32-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt32 An 32-bit unsigned integer equivalent to the value of this instance.
         */
        public function toUInt32(IFormatProvider $provider = null) 
        {
            
        }

        /**
         * Converts the value of this instance to an equivalent 64-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt64 An 64-bit unsigned integer equivalent to the value of this instance.
         */
        public function toUInt64(IFormatProvider $provider = null) 
        {
            
        }
    }
}