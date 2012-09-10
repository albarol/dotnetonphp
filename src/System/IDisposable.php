<?php

namespace System {

	/**
	 * Defines a method to release allocated resources.
	 * @access public
	 * @package System
	 * @name IDisposable
	 */
	interface IDisposable {

	    /**
	     * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
	     * @access public
	     * @return void
	     */
	    function dispose();

	}
}