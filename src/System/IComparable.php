<?php

namespace System {

	/**
	 * Defines a generalized comparison method that a value type or class implements to create a type-specific comparison method.
	 * @access public
	 * @name IComparable
	 * @package System
	 */
	interface IComparable {

	    /**
	     * Compares the current instance with another object of the same type.
	     * @param $obj An object to compare with this instance.
	     * @return A 32-bit signed integer that indicates the relative order of the objects being compared. The return value has these meanings: Value Meaning Less than zero This instance is less than obj. Zero This instance is equal to obj. Greater than zero This instance is greater than obj.
	     */
	    function compareTo($obj);

	}
}