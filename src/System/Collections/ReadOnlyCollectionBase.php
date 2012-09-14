<?php

namespace System\Collections {

	/**
	 * Returns an enumerator that iterates through the System.Collections.ReadOnlyCollectionBase instance.
	 * @access public
	 * @name ReadOnlyCollectionBase
	 * @package System
	 * @subpackage Collections
	 */
	abstract class ReadOnlyCollectionBase implements ICollection {

	    protected $InnerList;
	    
	    /**
	     * Initializes a new instance of the System.Collections.ReadOnlyCollectionBase class.
	     * @access protected
	     */
	    protected function __construct() { }
	}
}