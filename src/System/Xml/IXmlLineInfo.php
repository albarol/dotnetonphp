<?php

namespace System\Xml {
 
    /**
     * Provides an interface to enable a class to return line and position information.
     * @access public
     * @name IXmlLineInfo
     * @package System
     * @subpackage Xml
     */
    interface IXmlLineInfo {

        /**
         * Gets a value indicating whether the class can return line information.
         * @access public
         * @abstract
         * @return bool true if System.Xml.IXmlLineInfo.LineNumber and System.Xml.IXmlLineInfo.LinePosition can be provided; otherwise, false.
         */
        function hasLineInfo();

        /**
         * Gets the current line number.
         * @access public
         * @abstract
         * @return int The current line number or 0 if no line information is available (for example, System.Xml.IXmlLineInfo.HasLineInfo() returns false).
         */
        function lineNumber();

        /**
         * Gets the current line position.
         * @access public
         * @abstract
         * @return int The current line position or 0 if no line information is available (for example, System.Xml.IXmlLineInfo.HasLineInfo() returns false).
         */
        function linePosition();
    }
}