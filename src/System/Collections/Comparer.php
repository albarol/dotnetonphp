<?php

namespace System\Collections {

    use \System\Collections\IComparer as IComparer;

    use \System\Globalization\CultureInfo as CultureInfo;

    use \System\Runtime\Serialization\ISerializable as ISerializable;

    /**
     * Compares two objects for equivalence, where string comparisons are case-sensitive.
     * @access public
     * @final
     * @name Comparer
     * @package System
     * @subpackage Collections
     */
    final class Comparer implements IComparer, ISerializable {

        private $compareInfo;


        /**
         * Represents an instance of \System\Collections\Comparer that is associated with the \System\Threading\Thread\CurrentCulture of the current thread. This field is read-only.
         * @access public
         * @return Comparer
         */
        public function defaultVariant() {
            // TODO: vinculate with thread
        }

        /**
         * Represents an instance of \System\Collections\Comparer that is associated with \System\Globalization\CultureInfo\InvariantCulture. This field is read-only.
         * @access public
         * @return Comparer
         */
        public function defaultInvariant() {
            
        }


        /**
         * Initializes a new instance of the System.Collections.Comparer class using the specified System.Globalization.CultureInfo.
         * @access public
         * @throws \System\ArgumentNullException culture is null.
         * @param \System\Globalization\CultureInfo $cultureInfo The \System\Globalization\CultureInfo to use for the new \System\Collections\Comparer.
         */
        public function __construct(CultureInfo $cultureInfo) {
            
        }

        /**
         * Compares two objects and returns a value indicating whether one is less than, equal to, or greater than the other.
         * @access public
         * @throws \System\ArgumentException Neither a nor b implements the IComparable interface. -or- a and b are of different types and neither one can handle comparisons with the other.
         * @param object $x The first object to compare.
         * @param object $y The second object to compare.
         * @return int Less than zero if x is less than y. Zero if x equals y. Greater than zero if x is greater than y.
         */
        public function compare($x, $y) {
            
        }

        /**
         * Populates a System.Runtime.Serialization.SerializationInfo with the data needed to serialize the target object.
         * @access public
         * @throws \System\Security\SecurityException: The caller does not have the required permission.
         * @param \System\Runtime\Serialization\SerializationInfo $info The \System\Runtime\Serialization\SerializationInfo to populate with data.
         * @param \System\Runtime\Serialization\StreamingContext $context The destination for this serialization.
         */
        function getObjectData($info, $context)
        {
            // TODO: Implement getObjectData() method.
        }
    }
}