<?php

namespace System\IO;


require_once("SeekOrigin.php");
require_once(dirname(__FILE__)."/../IDisposable.php");
require_once(dirname(__FILE__).'/../InvalidOperationException.php');

use \System\IO\SeekOrigin as SeekOrigin;
use \System\IDisposable as IDisposable;
use \System\InvalidOperationException as InvalidOperationException;



/**
 * Provides a generic view of a sequence of bytes.
 * @access public
 * @abstract
 * @package System
 * @subpackage IO
 * @name Stream
 */
abstract class Stream implements IDisposable {

    protected $readTimeout;
    protected $writeTimeout;

    /**
     * When overridden in a derived class, gets a value indicating whether the current stream supports reading.
     * @abstract
     * @access public
     * @return bool true if the stream supports reading; otherwise, false.
     */
    public abstract function canRead();

    /**
     * When overridden in a derived class, gets a value indicating whether the current stream supports seeking.
     * @abstract
     * @access public
     * @return bool true if the stream supports seeking; otherwise, false.
     */
    public abstract function canSeek();

    /**
     * Gets a value that determines whether the current stream can time out.
     * @abstract
     * @access public
     * @return bool A value that determines whether the current stream can time out.
     */
    public abstract function canTimeout();

    /**
     * When overridden in a derived class, gets a value indicating whether the current stream supports writing.
     * @abstract
     * @access public
     * @return bool true if the stream supports writing; otherwise, false.
     */
    public abstract function canWrite();


    /**
     * Closes the current stream and releases any resources (such as sockets and file handles) associated with the current stream.
     * @access public
     * @return void
     */
    public function close() {
        $this->dispose();
    }


    /**
     * When overridden in a derived class, clears all buffers for this stream and causes any buffered data to be written to the underlying device.
     * @abstract
     * @access public
     * @throws IOException
     * @return void
     */
    public abstract function flush();


    /**
     * When overridden in a derived class, gets the length in bytes of the stream.
     * @abstract
     * @access public
     * @return float A long value representing the length of the stream in bytes.
     */
    public abstract function length();

    /**
     * When overridden in a derived class, gets or sets the position within the current stream.
     * @abstract
     * @access public
     * @param int $value Set the position
     * @return The current position within the stream.
     */
    public abstract function position($value=null);

    /**
     * When overridden in a derived class, reads a sequence of bytes from the current stream and advances the position within the stream by the number of bytes read.
     * @abstract
     * @access public
     * @throws ArgumentException|ArgumentNullException|ArgumentOutOfRangeException|IOException|NotSupportedException|ObjectDisposedException
     * @param array $buffer An array of bytes. When this method returns, the buffer contains the specified byte array with the values between offset and (offset + count - 1) replaced by the bytes read from the current source. 
     * @param int $offset The zero-based byte offset in buffer at which to begin storing the data read from the current stream. 
     * @param int $count The maximum number of bytes to be read from the current stream.
     * @return int The total number of bytes read into the buffer. This can be less than the number of bytes requested if that many bytes are not currently available, or zero (0) if the end of the stream has been reached.  
     */
    public abstract function read(&$buffer, $offset, $count);

    /**
     * Reads a byte from the stream and advances the position within the stream by one byte, or returns -1 if at the end of the stream.
     * @abstract
     * @access public
     * @return int The unsigned byte cast to an Int32, or -1 if at the end of the stream.
     */
    public abstract function readByte();

    /**
     * Gets or sets a value, in miliseconds, that determines how long the stream will attempt to read before timing out.
     * @access public
     * @throws InvalidOperationException
     * @param int $value Set a value, in miliseconds, that determines how long the stream will attempt to read before timing out.
     * @return int Get a value, in miliseconds, that determines how long the stream will attempt to read before timing out.
     */
    public function readTimeout($value=null) {
        if(!$this->canTimeout()) throw new InvalidOperationException("The stream does not support timing out");
        if($value != null)
            $this->readTimeout = $value;
        return $this->readTimeout;
    }

    /**
     * When overridden in a derived class, sets the position within the current stream.
     * @abstract
     * @access public
     * @throws IOException|NotSupportedException|ObjectDisposedException
     * @param float $offset A byte offset relative to the origin parameter.
     * @param string $origin A value of type SeekOrigin indicating the reference point used to obtain the new position.
     * @return float The new position within the current stream.
     */
    public abstract function seek($offset, $origin);

    /**
     * When overridden in a derived class, sets the length of the current stream.
     * @abstract
     * @access public
     * @throws IOException|NotSupportedException|ObjectDisposedException
     * @param int $value The desired length of the current stream in bytes.
     * @return void
     */
    public abstract function setLength($value);


    /**
     * Writes the stream contents to a byte array, regardless of the Position property.
     * @access public
     * @abstract
     * @return array A new byte array.
     */
    public abstract function toArray();


    /**
     * When overridden in a derived class, writes a sequence of bytes to the current stream and advances the current position within this stream by the number of bytes written.
     * @abstract
     * @access public 
     * @param array $array An array of bytes. This method copies count bytes from buffer to the current stream.
     * @param int $offset The zero-based byte offset in buffer at which to begin copying bytes to the current stream.
     * @param int $count The number of bytes to be written to the current stream. 
     * @return void
     */
    public abstract function write($array, $offset, $count);

    /**
     * Writes a byte to the current position in the stream and advances the position within the stream by one byte.
     * @abstract
     * @access public
     * @throws IOException|NotSupportedException|ObjectDisposedException
     * @param $value The byte to write to the stream.
     * @return void
     */
    public abstract function writeByte($value);

    /**
     * Gets or sets a value, in miliseconds, that determines how long the stream will attempt to write before timing out.
     * @access public
     * @throws InvalidOperationException
     * @param int $value Set a value, in miliseconds, that determines how long the stream will attempt to write before timing out.
     * @return int Get a value, in miliseconds, that determines how long the stream will attempt to write before timing out.
     */
    public function writeTimeout($value=null) {
        if(!$this->canTimeout()) throw new InvalidOperationException("The stream does not support timing out");
        if($value != null)
            $this->writeTimeout = $value;
        return $this->writeTimeout;
    }

}
?>