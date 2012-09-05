<?php

namespace System\Text;

require_once("Encoding.php");


/**
 * Represents an ASCII character encoding of Unicode characters.
 * @access public
 * @name ASCIIEncoding
 * @package System
 * @subpackage Text
 */
class ASCIIEncoding extends Encoding {

    /**
     * Creates a new object that is a copy of the current instance.
     * @access public
     * @return Object A new object that is a copy of this instance.
     */
    public function cloneObject() {
        return clone $this;
    }

    /**
     * When overridden in a derived class, calculates the number of bytes produced by encoding a set of characters from the specified character array.
     * @access public
     * @throws \System\ArgumentNullException|\System\ArgumentOutOfRangeException|\System\Text\EncoderFallbackException
     * @param $value The character array containing the set of characters to encode. -or- The System.String containing the set of characters to encode.
     * @param $index The index of the first character to encode.
     * @param $count The number of characters to encode.
     * @return The number of bytes produced by encoding the specified characters.
     */
    public function getByteCount($value, $index = null, $count = null)
    {
        // TODO: Implement getByteCount() method.
    }
}
