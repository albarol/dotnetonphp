<?php

namespace System;

/**
 * Defines a generalized method that a value type or class implements to create a type-specific method for determining equality of instances.
 * @access public
 * @name IEquatable
 * @package System
 */
interface IEquatable {

    /**
     * Indicates whether the current object is equal to another object of the same type.
     * @access public
     * @param $other An object to compare with this object.
     * @return bool true if the current object is equal to the other parameter; otherwise, false.
     */
    function equals($other);
}

?>
