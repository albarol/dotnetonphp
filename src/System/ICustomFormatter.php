<?php

namespace System {

	/**
	 * Defines a method that supports custom, user-defined formatting of the value of an object.
	 * @access public
	 * @name ICustomFormatter
	 * @package System
	 */
	interface ICustomFormatter {

	    /**
	     * Converts the value of a specified object to an equivalent string representation using specified format and culture-specific formatting information.
	     * @param $format A format string containing formatting specifications.
	     * @param $arg An object to format.
	     * @param $formatProvider An System.IFormatProvider object that supplies format information about the current instance.
	     * @return string The string representation of the value of arg, formatted as specified by format and formatProvider.
	     */
	    function format($format, $arg, $formatProvider);
	}
}