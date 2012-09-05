<?php

namespace System\Text;

/**
 * Provides a failure-handling mechanism, called a fallback, for an input character that cannot be converted to an encoded output byte sequence.
 * @access public
 * @name EncoderFallback
 * @package System
 * @subpackage Text
 */
abstract class EncoderFallback {

    /**
     * When overridden in a derived class, initializes a new instance of the System.Text.EncoderFallbackBuffer class.
     * @access public
     * @abstract
     * @return \System\Text\EncoderFallbackBuffer A System.Text.EncoderFallbackBuffer object.
     */
    public abstract function createFallbackBuffer();

    /**
     * Initializes a new instance of the System.Text.EncoderFallback class.
     * @access protected
     */
    protected function __construct() { }

    /**
     * Gets an object that throws an exception when an input character cannot be encoded.
     * @access public
     * @static
     * @return \System\Text\EncoderFallback A type derived from the System.Text.EncoderFallback class. The default value is a System.Text.EncoderExceptionFallback object.
     */
    public static function exceptionFallback() { }

    /**
     * When overridden in a derived class, gets the maximum number of characters the current System.Text.EncoderFallback object can return.
     * @access public
     * @return int The maximum number of characters the current System.Text.EncoderFallback object can return.
     */
    public abstract function maxCharCount();


    /**
     * Gets an object that outputs a substitute string in place of an input character that cannot be encoded.
     * @access public
     * @static
     * @return \System\Text\EncoderFallback A type derived from the System.Text.EncoderFallback class. The default value is a System.Text.EncoderReplacementFallback object that replaces unknown input characters with the QUESTION MARK character ("?", U+003F).
     */
    public static function replacementFallback() { }
}
?>
