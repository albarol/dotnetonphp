<?php

namespace System\IO;

require_once(dirname(__FILE__)."/../ArgumentException.php");



use System\IO\Stream as Stream;
use System\Text\Encoding as Encoding;
use System\ArgumentException as ArgumentException;

/**
 * Reads primitive data types as binary values in a specific encoding.
 * @access public
 * @name BinaryReader
 * @package System
 * @subpackage IO
 */
class BinaryReader {

    private $stream;


    /**
     * Initializes a new instance of the System.IO.BinaryReader class based on the supplied stream and a specific character encoding.
     * @access public
     * @throws \System\ArgumentException The stream does not support reading, the stream is null, or the stream is already closed.
     * @throws \System\ArgumentNullException encoding is null.
     * @param Stream $input The supplied stream
     * @param \System\Text\Encoding $encoding The character encoding.
     */
    public function __construct(Stream $input, Encoding $encoding=null) {
        if($input == null || !$input->canRead()) {
            throw new ArgumentException("The stream does not support reading, the stream is null, or the stream is already closed.");
        }


    }

    /**
     * Exposes access to the underlying stream of the System.IO.BinaryReader.
     * @access public
     * @return Stream The underlying stream associated with the BinaryReader.
     */
    public function baseStream() {
        return $this->stream;
    }

    /**
     * Closes the current reader and the underlying stream.
     * @access public
     */
    public function close() {
        unset($this->stream);
    }

    /**
     * Releases the unmanaged resources used by the System.IO.BinaryReader and optionally releases the managed resources.
     * @access protected
     * @param bool $disposing true to release both managed and unmanaged resources; false to release only unmanaged resources.
     */
    protected function dispose($disposing=false) {
       $this->close();
    }

    /**
     * Fills the internal buffer with the specified number of bytes read from the stream.
     * @access protected
     * @throws \System\IO\EndOfStreamException The end of the stream is reached before numBytes could be read.
     * @throws \System\IO\IOException An I/O error occurs.
     * @throws \System\ArgumentOutOfRangeException Requested numBytes is larger than the internal buffer size.
     * @param int $numBytes The number of bytes to be read.
     */
    protected function fillBuffer($numBytes=0) {

    }

    /**
     * Returns the next available character and does not advance the byte or character position.
     * @access public
     * @throws \System\IO\IOException The next available character, or -1 if no more characters are available or the stream does not support seeking.
     * @return int The next available character, or -1 if no more characters are available or the stream does not support seeking.
     */
    public function peekChar() {

    }


    /**
     * Reads characters from the underlying stream and advances the current position of the stream in accordance with the Encoding used and the specific character being read from the stream.
     * @access public
     * @throws \System\IO\IOException An I/O error occurs.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @param array $buffer The buffer to read data into.
     * @param int $index The starting point in the buffer at which to begin reading into the buffer.
     * @param int $count The number of characters to read.
     * @return int The next character from the input stream, or -1 if no characters are currently available.
     */
    public function read($buffer=array(), $index=null, $count=null) {

    }

    /**
     * Reads in a 32-bit integer in compressed format.
     * @access protected
     * @throws \System\IO\EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws \System\IO\IOException An I/O error occurs.
     * @throws \System\FormatException The stream is corrupted.
     * @return int A 32-bit integer in compressed format.
     */
    protected function read7BitEncodedInt() {

    }

    /**
     * Reads a Boolean value from the current stream and advances the current position of the stream by one byte.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return bool true if the byte is nonzero; otherwise, false.
     */
    public function readBoolean()
    {

    }


    /**
     * Reads the next byte from the current stream and advances the current position of the stream by one byte.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int The next byte read from the current stream.
     */
    public function readByte()
    {

    }

    /**
     * Reads count bytes from the current stream into a byte array and advances the current position by count bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @param int $count The number of bytes to read.
     * @return array A byte array containing data read from the underlying stream. This might be less than the number of bytes requested if the end of the stream is reached.
     */
    public function readBytes($count=0)
    {

    }

    /**
     * Reads the next character from the current stream and advances the current position of the stream in accordance with the Encoding used and the specific character being read from the stream.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return string A character read from the current stream.
     */
    public function readChar()
    {

    }

    /**
     * Reads count characters from the current stream, returns the data in a character array, and advances the current position in accordance with the Encoding used and the specific character being read from the stream.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @param int $count The number of characters to read.
     * @return array A character array containing data read from the underlying stream. This might be less than the number of characters requested if the end of the stream is reached.
     */
    public function readChars($count=0)
    {

    }

    /**
     * Reads a decimal value from the current stream and advances the current position of the stream by sixteen bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int A decimal value read from the current stream.
     */
    public function readDecimal()
    {

    }

    /**
     * Reads an 8-byte floating point value from the current stream and advances the current position of the stream by eight bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return float An 8-byte floating point value read from the current stream.
     */
    public function readDouble()
    {

    }

    /**
     * Reads a 2-byte signed integer from the current stream and advances the current position of the stream by two bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int A 2-byte signed integer read from the current stream.
     */
    public function readInt16() {

    }

    /**
     * Reads a 4-byte signed integer from the current stream and advances the current position of the stream by four bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int A 4-byte signed integer read from the current stream.
     */
    public function readInt32() {

    }

    /**
     * Reads an 8-byte signed integer from the current stream and advances the current position of the stream by eight bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int An 8-byte signed integer read from the current stream.
     */
    public function readInt64() {

    }

    /**
     * Reads a signed byte from this stream and advances the current position of the stream by one byte.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int A signed byte read from the current stream.
     */
    public function readSByte() {

    }

    /**
     * Reads a 4-byte floating point value from the current stream and advances the current position of the stream by four bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return float A 4-byte floating point value read from the current stream.
     */
    public function readSingle() {

    }

    /**
     * Reads a string from the current stream. The string is prefixed with the length, encoded as an integer seven bits at a time.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return string The string being read.
     */
    public function readString() {

    }

    /**
     * Reads a 2-byte unsigned integer from the current stream using little-endian encoding and advances the position of the stream by two bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int A 2-byte unsigned integer read from this stream.
     */
    public function readUInt16() {

    }

    /**
     * Reads a 4-byte unsigned integer from the current stream and advances the position of the stream by four bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int A 4-byte unsigned integer read from this stream.
     */
    public function readUInt32() {

    }

    /**
     * Reads an 8-byte unsigned integer from the current stream and advances the position of the stream by eight bytes.
     * @access public
     * @throws EndOfStreamException The end of the stream is reached.
     * @throws \System\ObjectDisposedException The stream is closed.
     * @throws IOException An I/O error occurs.
     * @return int An 8-byte unsigned integer read from this stream.
     */
    public function readUInt64() {

    }





}
?>