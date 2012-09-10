<?php

namespace System {

	/**
	 * Provides functionality to format the value of an object into a string representation.
	 * @access public
	 * @package System
	 * @name IFormattable
	 */
	interface IFormattable {

	    /**
	     * Formats the value of the current instance using the specified format.
	     * @param String $format The System.String specifying the format to use.-or- null to use the default format defined for the type of the System.IFormattable implementation.
	     * @param IFormatProvider $formatProvider The System.IFormatProvider to use to format the value.-or- null to obtain the numeric format information from the current locale setting of the operating system.
	     * @return String A System.String containing the value of the current instance in the specified format.
	     */
	    function toString($format, IFormatProvider $formatProvider);

	}

}
