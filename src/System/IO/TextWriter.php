<?php

namespace System\IO;

require_once(dirname(__FILE__).'/../Object.php');
require_once(dirname(__FILE__).'/../IDisposable.php');
require_once(dirname(__FILE__)."/../text/ASCIIEncoding.php");
require_once(dirname(__FILE__).'/../ObjectDisposedException.php');


/**
 * TODO: Implement encoding()
 * TODO: Implement formatProvider()
 * TODO: Implement __construct
 */

/**
 * Represents a writer that can write a sequential series of characters. This class is abstract.
 * @access public
 * @abstract
 * @name TextWriter
 * @package System
 * @subpackage IO
 */
abstract class TextWriter extends \System\Object implements \System\IDisposable {

    /**
     * @var string Stores the new line characters used for this TextWriter.
     */
    protected $CoreNewLine = "\r\n";

    /**
     * @var resource Resource
     */
    protected $resource;

    /**
     * @var string Provides a TextWriter with no backing store that can be written to, but not read from.
     */
    const Null = "";


    private $newLine;


    /**
     * Closes the current writer and releases any system resources associated with the writer.
     * @access public
     * @return void
     */
    public function close(){
        unset($this->resource);
    }

    /**
     * Releases all resources used by the System.IO.TextWriter object.
     * @access public
     * @return void
     */
    public function dispose() {
        unset($this->resource);
    }


    /**
     * When overridden in a derived class, returns the System.Text.Encoding in which the output is written.
     * @access public
     * @return Encoding The Encoding in which the output is written.
     */
    public abstract function encoding();


    /**
     * Clears all buffers for the current writer and causes any buffered data to be written to the underlying device.
     * @access public
     * @return void
     */
    public function flush() { }


    /**
     * Gets an object that controls formatting.
     * @access public
     * @return IFormatProvider An System.IFormatProvider object for a specific culture, or the formatting of the current culture if no other culture is specified.
     */
    public function formatProvider() { }


    /**
     * Gets or sets the line terminator string used by the current TextWriter.
     * @access public
     * @param string $value sets the line terminator
     * @return string The line terminator string for the current TextWriter.
     */
    public function newLine($value=null) {
        if($value != null)
            $this->newLine = $value;
        return $this->newLine;
    }


    /**
     * Creates a thread-safe wrapper around the specified TextWriter.
     * @static
     * @throws ArgumentNullException
     * @param TextWriter $writer The TextWriter to synchronize. 
     * @return TextWriter A thread-safe wrapper.
     */
    public static function synchronized(TextWriter $writer) {
        return clone $writer;
    }

    /**
     * Initializes a new instance of the System.IO.TextWriter class with the specified format provider.
     * @constructor
     * @param IFormatProvider $formatProvider An System.IFormatProvider object that controls formatting.
     */
    protected function __construct(IFormatProvider $formatProvider) { }

    /**
     * Writes the text representation of an object to the text stream by calling ToString on that object.
     * @access public
     * @throws ObjectDisposedException|IOException
     * @param $value The object to write. 
     * @return void
     */
    public abstract function write($value);


    /**
     * Writes the text representation of an object by calling ToString on this object, followed by a line terminator to the text stream.
     * @access public
     * @throws ObjectDisposedException|IOException
     * @param object $value The object to write. If value is null, only the line termination characters are written.
     * @return void
     */
    public abstract function writeLine($value);
}
