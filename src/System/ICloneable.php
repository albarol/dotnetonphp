<?php

namespace System {

	/**
	 * Supports cloning, which creates a new instance of a class with the same value as an existing instance.
	 * @access public
	 * @package System
	 * @name ICloneable
	 */
	interface ICloneable {

	    /**
	     * Creates a new object that is a copy of the current instance.
	     * @access public
	     * @return Object A new object that is a copy of this instance.
	     */
	    function cloneObject();
	}
}
