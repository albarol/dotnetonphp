<?php

namespace System\Globalization
{

    /**
     * Provides functionality to split a string into text elements and to iterate through those text elements.
     * @access public
     * @package System
     * @subpackage Globalization
     * @name StringInfo
     */
    class StringInfo
    {
        /**
         * Initializes a new instance of the StringInfo class to a specified string.
         * @access public
         * @throws \System\ArgumentNullException
         * @param $value A string to initialize this StringInfo object.
         */
        public function __construct($value="") { }

        /**
         * Gets the text element at the specified index of the specified string.
         * @static
         * @param $str The string from which to get the text element.
         * @param $index The zero-based index at which the text element starts.
         * @return string A string containing the text element at the specified index of the specified string.
         */
        public static function getNextTextElement($str, $index) { }

        /**
         * Returns an enumerator that iterates through the text elements of the string, starting at the specified index.
         * @access public
         * @static
         * @param $str The string to iterate through.
         * @param $index The zero-based index at which to start iterating.
         * @return TextElementEnumerator A TextElementEnumerator for the string starting at index.
         */
        public static function getTextElementEnumerator($str, $index) { }

        /**
         * Returns the indexes of each base character, high surrogate, or control character within the specified string.
         * @static
         * @param $str The string to search.
         * @return array An array of integers that contains the zero-based indexes of each base character, high surrogate, or control character within the specified string.
         */
        public static function parseCombiningCharacters($str) { }

        /**
         * Retrieves a substring of text elements from the current StringInfo object starting from a specified text element and continuing through the specified number of text elements.
         * @access public
         * @param int $startingTextElement The index of a text element in this StringInfo object.
         * @param int $lengthInTextElements The number of text elements to retrieve.
         * @return string A substring of text elements in this StringInfo object.The substring consists of the number of text elements specified by the lengthInTextElements parameter and starts from the text element index specified by the startingTextElement parameter.
         */
        public function substringByTextElements($startingTextElement, $lengthInTextElements) { }


        /**
         * Gets the number of text elements in the current StringInfo object.
         * @access public
         * @return int The number of base characters, surrogate pairs, and combining character sequences in this StringInfo object.
         */
        public function lengthInTextElements() { }

        /**
         * Gets or sets the value of the current StringInfo object.
         * @access public
         * @param object $value The string that is the value of the current StringInfo object.
         * @return string gets the value of the current StringInfo
         */
        public function stringValue($value=null) { }
    }
}