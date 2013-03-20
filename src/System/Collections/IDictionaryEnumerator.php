<?php

namespace System\Collections;

    use \System\Collections\IEnumerator as IEnumerator;

    /**
     * Enumerates the elements of a nongeneric dictionary.
     * @access public
     * @name IDictionaryEnumerator
     * @package System
     * @subpackage Collections
     */
    interface IDictionaryEnumerator extends IEnumerator {

        /**
         * Gets both the key and the value of the current dictionary entry.
         * @access public
         * @throws \System\InvalidOperationException The System.Collections.IDictionaryEnumerator is positioned before the first entry of the dictionary or after the last entry.
         * @return \System\Collections\DictionaryEntry A System.Collections.DictionaryEntry containing both the key and the value of the current dictionary entry.
         */
        function entry();

        /**
         * Gets the key of the current dictionary entry.
         * @access public
         * @throws \System\InvalidOperationException The System.Collections.IDictionaryEnumerator is positioned before the first entry of the dictionary or after the last entry.
         * @return object The key of the current element of the enumeration.
         */
        function key();


        /**
         * Gets the value of the current dictionary entry.
         * @access public
         * @throws \System\InvalidOperationException: The System.Collections.IDictionaryEnumerator is positioned before the first entry of the dictionary or after the last entry.
         * @return object The value of the current element of the enumeration.
         */
        function value();
    }
}