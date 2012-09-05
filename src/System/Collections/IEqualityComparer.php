<?php

namespace System\Collections;

/*
 * Defines methods to support the comparison of objects for equality.
 */
interface IEqualityComparer {

    /*
     * Determines whether the specified objects are equal.
     *
     * @param x: The first object to compare.
     * @param y: The second object to compare.
     *
     * @return true if the specified objects are equal; otherwise, false.
     *
     * @throws System.ArgumentException: x and y are of different types and neither one can handle comparisons with the other.
     */
    function equals($x, $y);

    /*
     * Returns a hash code for the specified object.
     *
     * @param obj: The System.Object for which a hash code is to be returned.
     *
     * @return A hash code for the specified object.
     *
     * @throws System.ArgumentNullException: The type of obj is a reference type and obj is null.
     */
    function getHashCode($obj);
}
?>
