<?php

namespace System\Collections;

/**
 * Exposes a method that compares two objects.
 * @access public
 * @name IComparer
 * @package System
 * @subpackage Collections
 */
interface IComparer {

    /**
     * Compares two objects and returns a value indicating whether one is less than, equal to, or greater than the other.
     * @access public
     * @throws ArgumentException
     * @param object $x The first object to compare.
     * @param object $y The second object to compare.
     * @return int Less than zero if x is less than y. Zero if x equals y. Greater than zero if x is greater than y.
     */
    function compare($x, $y);
}
?>
