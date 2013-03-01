<?php

namespace System\IO;

require_once(dirname(__FILE__).'/../IDisposable.php');
require_once("IOException.php");
require_once(dirname(__FILE__)."/../ObjectDisposedException.php");
require_once(dirname(__FILE__)."/../ArgumentNullException.php");
require_once(dirname(__FILE__)."/../ArgumentException.php");


use \System\IDisposable as IDisposable;
use \System\ArgumentNullException as ArgumentNullException;
use \System\ArgumentException as ArgumentException;


/**
 * Represents a reader that can read a sequential series of characters.
 * @access public
 * @abstract
 * @name TextReader
 * @package System
 * @subpackage IO
 */
abstract class TextReader implements IDisposable {

    protected $resource;

    protected function __construct() { }

    /**
     * Closes the System.IO.TextReader and releases any system resources associated with the TextReader.
     * @access public
     * @return void
     */
    public function close() {
        unset($this->resource);
    }

    /**
     * Reads the next character without changing the state of the reader or the character source. Returns the next available character without actually reading it from the input stream.
     * @access public
     * @return int An integer representing the next character to be read, or -1 if no more characters are available or the stream does not support seeking.
     */
    public abstract function peek();


    /**
     * Reads the next character from the input stream and advances the character position by one character.
     * @access public
     * @throws ArgumentNullException|ArgumentException|ArgumentOutOfRangeException|ObjectDisposedException|IOException
     * @param array $buffer When this method returns, contains the specified character array with the values between index and (index + count - 1) replaced by the characters read from the current source.
     * @param int $index The place in buffer at which to begin writing.
     * @param int $count The maximum number of characters to read. If the end of the stream is reached before count of characters is read into buffer, the current method returns.
     * @return int The number of characters that have been read. The number will be less than or equal to count, depending on whether the data is available within the stream. This method returns zero if called when no more characters are left to read.
     */
    public abstract function read(&$buffer=array(), $index=null, $count=null);


    /**
     * Read next character
     * @access protected
     * @return string
     */
    protected abstract function readOnlyCharacter();


    /**
     * Reads a maximum of count characters from the current stream, and writes the data to buffer, beginning at index.
     * @access public
     * @throws ArgumentNullException|ArgumentException|ArgumentOutOfRangeException|ObjectDisposedException|IOException
     * @param array $buffer When this method returns, contains the specified character array with the values between index and (index + count - 1) replaced by the characters read from the current source.
     * @param $index The place in buffer at which to begin writing.
     * @param $count The maximum number of characters to read. If the end of the stream is reached before count of characters is read into buffer, the current method returns.
     * @return int The position of the underlying stream is advanced by the number of characters that were read into buffer.
     */
    public abstract  function readBlock(&$buffer, $index, $count);

    /**
     * Reads a line of characters from the current stream and returns the data as a string.
     * @access public
     * @throws IOException|OutOfMemoryException|ObjectDisposedException|ArgumentOutOfRangeException
     * @return string The next line from the input stream, or null if all characters have been read.
     */
    public abstract function readLine();


    /**
     * Reads all characters from the current position to the end of the TextReader and returns them as one string.
     * @access public
     * @throws IOException|ObjectDisposedException|OutOfMemoryException|ArgumentOutOfRangeException
     * @return string A string containing all characters from the current position to the end of the TextReader.
     */
    public abstract function readToEnd();


    /**
     * Creates a thread-safe wrapper around the specified TextReader.
     * @static
     * @throws ArgumentNullException
     * @param TextReader $reader The TextReader to synchronize. 
     * @return TextReader A thread-safe System.IO.TextReader.
     */
    public static function synchronized(TextReader $reader) {
        return clone $reader;
    }
}
?>