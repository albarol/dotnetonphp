<?php

/**
 * Table of atomized string objects.
 * @access public
 * @name XmlNameTable
 * @package System
 * @subpackage Xml
 */
abstract class XmlNameTable {

    /**
     * When overridden in a derived class, atomizes the specified string and adds it to the XmlNameTable.
     * @access public
     * @throws ArgumentNullException
     * @abstract
     * @param $array The name to add.
     * @return XmlNameTable The new atomized string or the existing one if it already exists.
     */
    public abstract function add($array);


    /**
     * When overridden in a derived class, gets the atomized string containing the same value as the specified string.
     * @access public
     * @throws ArgumentNullException
     * @abstract
     * @param $array The name to look up.
     * @return XmlNameTable The atomized string or null if the string has not already been atomized.
     */
    public abstract function get($array);
}

?>
