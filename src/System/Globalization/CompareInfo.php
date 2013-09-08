<?php

namespace System\Globalization
{

    use System\Reflection\Assembly as Assembly;


    /**
     * Implements a set of methods for culture-sensitive string comparisons.
     * @access public
     * @name CompareInfo
     * @package System
     * @subpackage Globalization
     */
    class CompareInfo {

        /**
         * Compares a section of one string with a section of another string using the specified System.Globalization.CompareOptions value.
         * @access public
         * @param string $string1 The first string to compare.
         * @param $offset1 The zero-based index of the character in string1 at which to start comparing.
         * @param $length1 The number of consecutive characters in string1 to compare.
         * @param string $string2 The second string to compare.
         * @param $offset2 The zero-based index of the character in string2 at which to start comparing.
         * @param $length2 The number of consecutive characters in string2 to compare.
         * @param CompareOptions $options The System.Globalization.CompareOptions value that defines how string1 and string2 should be compared. options is either the value System.Globalization.CompareOptions.Ordinal used by itself, or the bitwise combination of one or more of the following values: System.Globalization.CompareOptions.IgnoreCase, System.Globalization.CompareOptions.IgnoreSymbols, System.Globalization.CompareOptions.IgnoreNonSpace, System.Globalization.CompareOptions.IgnoreWidth, System.Globalization.CompareOptions.IgnoreKanaType, and System.Globalization.CompareOptions.StringSort.
         */
        public function compare($string1, $offset1, $length1, $string2, $offset2, $length2, CompareOptions $options=null) { }

        /**
         * Initializes a new System.Globalization.CompareInfo object that is associated with the specified culture and that uses string comparison methods in the specified System.Reflection.Assembly.
         * @access public
         * @static
         * @throws \System\ArgumentNullException
         * @param $culture A string representing the culture name. -or- An integer representing the culture identifier.
         * @param \System\Reflection\Assembly $assembly An System.Reflection.Assembly that contains the string comparison methods to use.
         * @return \System\Globalization\CompareInfo A new System.Globalization.CompareInfo object associated with the culture with the specified identifier and using string comparison methods in the current System.Reflection.Assembly.
         */
        public static function getCompareInfo($culture, Assembly $assembly) { }

        /**
         * Gets the sort key for the specified string.
         * @access public
         * @throws \System\ArgumentException
         * @param $source The string for which a System.Globalization.SortKey object is obtained.
         * @param CompareOptions $options The System.Globalization.CompareOptions value that define how the sort key is calculated. options is a bitwise combination of one or more of the following values: System.Globalization.CompareOptions.IgnoreCase, System.Globalization.CompareOptions.IgnoreSymbols, System.Globalization.CompareOptions.IgnoreNonSpace, System.Globalization.CompareOptions.IgnoreWidth, System.Globalization.CompareOptions.IgnoreKanaType, and System.Globalization.CompareOptions.StringSort.
         * @return \System\Globalization\SortKey The System.Globalization.SortKey object that contains the sort key for the specified string.
         */
        public function getSortKey($source, CompareOptions $options=null) { }

        /**
         * Searches for the specified character and returns the zero-based index of the first occurrence within the section of the source string that starts at the specified index and contains the specified number of elements using the specified System.Globalization.CompareOptions value.
         * @access public
         * @throws \System\ArgumentNullException|\System\ArgumentOutOfRangeException|\System\ArgumentException
         * @param $source The string to search.
         * @param $value The character to locate within source.
         * @param $startIndex The zero-based starting index of the search.
         * @param $count The number of elements in the section to search.
         * @param CompareOptions $options The System.Globalization.CompareOptions value that defines how source and value should be compared. options is either the value System.Globalization.CompareOptions.Ordinal used by itself, or the bitwise combination of one or more of the following values: System.Globalization.CompareOptions.IgnoreCase, System.Globalization.CompareOptions.IgnoreSymbols, System.Globalization.CompareOptions.IgnoreNonSpace, System.Globalization.CompareOptions.IgnoreWidth, and System.Globalization.CompareOptions.IgnoreKanaType.
         * @return int The zero-based index of the first occurrence of value within the section of source that starts at startIndex and contains the number of elements specified by count, using the specified System.Globalization.CompareOptions value, if found; otherwise, -1.
         */
        public function indexOf($source, $value, $startIndex, $count, CompareOptions $options=null) { }

        /**
         * Determines whether the specified source string starts with the specified prefix using the specified System.Globalization.CompareOptions value.
         * @access public
         * @throws \System\ArgumentNullException|\System\ArgumentException
         * @param $source The string to search in.
         * @param $prefix The string to compare with the beginning of source.
         * @param CompareOptions $options The System.Globalization.CompareOptions value that defines how source and prefix should be compared. options is either the value System.Globalization.CompareOptions.Ordinal used by itself, or the bitwise combination of one or more of the following values: System.Globalization.CompareOptions.IgnoreCase, System.Globalization.CompareOptions.IgnoreSymbols, System.Globalization.CompareOptions.IgnoreNonSpace, System.Globalization.CompareOptions.IgnoreWidth, and System.Globalization.CompareOptions.IgnoreKanaType.
         * @return bool true if the length of prefix is less than or equal to the length of source and source starts with prefix; otherwise, false.
         */
        public function isPrefix($source, $prefix, CompareOptions $options=null) { }

        /**
         * Indicates whether a specified Unicode string is sortable.
         * @access public
         * @static
         * @param $text A string of zero or more Unicode characters.
         * @return bool true if the str parameter is not an empty string ("") and all the Unicode characters in str are sortable; otherwise, false.
         */
        public static function isSortable($text) { }

        /**
         * Determines whether the specified source string ends with the specified suffix using the specified System.Globalization.CompareOptions value.
         * @access public
         * @throws \System\ArgumentNullException|\System\ArgumentException
         * @param $source The string to search in.
         * @param $suffix The string to compare with the end of source.
         * @param CompareOptions $options The System.Globalization.CompareOptions value that defines how source and suffix should be compared. options is either the value System.Globalization.CompareOptions.Ordinal used by itself, or the bitwise combination of one or more of the following values: System.Globalization.CompareOptions.IgnoreCase, System.Globalization.CompareOptions.IgnoreSymbols, System.Globalization.CompareOptions.IgnoreNonSpace, System.Globalization.CompareOptions.IgnoreWidth, and System.Globalization.CompareOptions.IgnoreKanaType.
         * @return bool true if the length of suffix is less than or equal to the length of source and source ends with suffix; otherwise, false.
         */
        public function isSuffix($source, $suffix, CompareOptions $options=null) { }

        /**
         * Searches for the specified character and returns the zero-based index of the last occurrence within the section of the source string that contains the specified number of elements and ends at the specified index using the specified System.Globalization.CompareOptions value.
         * @access public
         * @throws \System\ArgumentNullException|\System\ArgumentException
         * @param $source The string to search.
         * @param $value The character to locate within source.
         * @param $startIndex The zero-based starting index of the backward search.
         * @param $count The number of elements in the section to search.
         * @param CompareOptions $options The System.Globalization.CompareOptions value that defines how source and value should be compared. options is either the value System.Globalization.CompareOptions.Ordinal used by itself, or the bitwise combination of one or more of the following values: System.Globalization.CompareOptions.IgnoreCase, System.Globalization.CompareOptions.IgnoreSymbols, System.Globalization.CompareOptions.IgnoreNonSpace, System.Globalization.CompareOptions.IgnoreWidth, and System.Globalization.CompareOptions.IgnoreKanaType.
         * @return bool The zero-based index of the last occurrence of value within the section of source that contains the number of elements specified by count and ends at startIndex using the specified System.Globalization.CompareOptions value, if found; otherwise, -1.
         */
        public function lastIndexOf($source, $value, $startIndex, $count, CompareOptions $options=null) { }

        /**
         * Gets the properly formed culture identifier for the current System.Globalization.CompareInfo.
         * @return int The properly formed culture identifier for the current System.Globalization.CompareInfo.
         */
        public function lcid() { }

        /**
         * Gets the name of the culture used for sorting operations by this System.Globalization.CompareInfo object.
         * @return string The name of a culture.
         */
        public function name() { }
    }
}
