<?php

namespace System\Collections;

require_once("IComparer.php");
 
class CaseInsensitiveComparer implements IComparer {


    /**
     * Performs a case-insensitive comparison of two objects of the same type and returns a value indicating whether one is less than, equal to, or greater than the other.
     * @access public
     * @param CultureInfo $culture Initializes a new instance of the System.Collections.CaseInsensitiveComparer class using the specified System.Globalization.CultureInfo.
     */
    public function __construct($culture=null) {

    }


    /**
     * Compares two objects and returns a value indicating whether one is less than, equal to, or greater than the other.
     * @access public
     * @throws ArgumentException
     * @param object $x The first object to compare.
     * @param object $y The second object to compare.
     * @return int Less than zero if x is less than y. Zero if x equals y. Greater than zero if x is greater than y.
     */
    function compare($x, $y) {
        // TODO: Implement compare() method.
    }


    /**
     * Gets an instance of System.Collections.CaseInsensitiveComparer that is associated with the System.Threading.Thread.CurrentCulture of the current thread and that is always available.
     * @static
     * @return CaseInsensitiveComparer An instance of System.Collections.CaseInsensitiveComparer that is associated with the System.Threading.Thread.CurrentCulture of the current thread.
     */
    public static function defaultVariant() {

    }


    /**
     * Gets an instance of System.Collections.CaseInsensitiveComparer that is associated with System.Globalization.CultureInfo.InvariantCulture and that is always available.
     * @static
     * @return CaseInsensitiveComparer An instance of System.Collections.CaseInsensitiveComparer that is associated with System.Globalization.CultureInfo.InvariantCulture.
     */
    public static function defaultInvariant() {

    }


}
?>