<?php

namespace System\Globalization;

/**
 * Represents the result of mapping a string to its sort key.
 * @package System
 * @subpackage Globalization
 * @name SortKey
 */
class SortKey
{
    /**
     * Compares two sort keys.
     * @access public
     * @static
     * @throws \System\ArgumentNullException
     * @param SortKey $sortKey1 The first sort key to compare.
     * @param SortKey $sortKey2 The second sort key to compare.
     */
    public static function compare(SortKey $sortKey1, SortKey $sortKey2) { }

    /**
     * Gets the byte array representing the current SortKey object.
     * @access public
     * @return array A byte array representing the current SortKey object.
     */
    public function keyData() { }

    /**
     * Gets the original string used to create the current SortKey object.
     * @access public
     * @return string The original string used to create the current SortKey object.
     */
    public function originalString() { }
}
?>