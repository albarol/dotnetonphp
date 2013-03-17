<?php
namespace System\Globalization
{
   use System\Enum as Enum;

    /**
     * Defines the string comparison options to use with System.Globalization.CompareInfo.
     * @access public
     * @name CompareOptions
     * @package System
     * @subpackage Globalization
     */
    class CompareOptions extends Enum 
    {
        private function __construct($name, $value) 
        {
            $this->name = $name;
            $this->value = $value;
        }


        /**
         * Indicates that the string comparison must ignore case.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function IgnoreCase() 
        {
            return new CompareOptions("IgnoreCase", 1);
        }


        /**
         * Indicates that the string comparison must ignore the Kana type. Kana type refers to Japanese hiragana and katakana characters, which represent phonetic sounds in the Japanese language. Hiragana is used for native Japanese expressions and words, while katakana is used for words borrowed from other languages, such as "computer" or "Internet". A phonetic sound can be expressed in both hiragana and katakana. If this value is selected, the hiragana character for one sound is considered equal to the katakana character for the same sound.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function IgnoreKanaType() 
        {
            return new CompareOptions("IgnoreKanaType", 8);
        }

        /**
         * Indicates that the string comparison must ignore nonspacing combining characters, such as diacritics. The Unicode Standard defines combining characters as characters that are combined with base characters to produce a new character. Nonspacing combining characters do not occupy a spacing position by themselves when rendered. For more information on nonspacing combining characters, see The Unicode Standard at the Unicode home page.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function IgnoreNonSpace() 
        {
            return new CompareOptions("IgnoreNonSpace", 2);
        }

        /**
         * Indicates that the string comparison must ignore symbols, such as white-space characters, punctuation, currency symbols, the percent sign, mathematical symbols, the ampersand, and so on.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function IgnoreSymbols() 
        {
            return new CompareOptions("IgnoreSymbols", 4);
        }

        /**
         * Indicates that the string comparison must ignore the character width. For example, Japanese katakana characters can be written as full-width or half-width. If this value is selected, the katakana characters written as full-width are considered equal to the same characters written as half-width.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function IgnoreWidth() 
        {
            return new CompareOptions("IgnoreWidth", 16);
        }

        /**
         * Indicates the default option settings for string comparisons.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function None() 
        {
            return new CompareOptions("None", 0);
        }

        /**
         * Indicates that the string comparison must use the Unicode values of each character, leading to a fast comparison but one that is culture-insensitive. A string starting with "U+xxxx" comes before a string starting with "U+yyyy", if xxxx is less than yyyy. This value cannot be combined with other System.Globalization.CompareOptions values and must be used alone.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function Ordinal() 
        {
            return new CompareOptions("Ordinal", 1073741824);
        }

        /**
         * String comparison must ignore case, then perform an ordinal comparison. This technique is equivalent to converting the string to uppercase using the invariant culture and then performing an ordinal comparison on the result.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function OrdinalIgnoreCase() 
        {
            return new CompareOptions("OrdinalIgnoreCase", 268435456);
        }

        /**
         * Indicates that the string comparison must use the string sort algorithm. In a string sort, the hyphen and the apostrophe, as well as other nonalphanumeric symbols, come before alphanumeric characters.
         * @access public
         * @return \System\Globalization\CompareOptions
         */
        public static function StringSort() 
        {
            return new CompareOptions("StringSort", 536870912);
        }
    }
}
