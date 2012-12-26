<?php

namespace System\IO {

    use \System\IO\Stream as Stream;

    /**
     * Adds a buffering layer to read and write operations on another stream. This class cannot be inherited.
     * @access public
     * @package System
     * @subpackage IO
     * @name BufferedStream
     */
    final class BufferedStream extends Stream {

        /**
         * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
         * @access public
         * @return void
         */
        function dispose()
        {
            // TODO: Implement dispose() method.
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports reading.
         * @access public
         * @return bool true if the stream supports reading; otherwise, false.
         */
        public function canRead()
        {
            // TODO: Implement canRead() method.
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports seeking.
         * @access public
         * @return bool true if the stream supports seeking; otherwise, false.
         */
        public function canSeek()
        {
            // TODO: Implement canSeek() method.
        }

        /**
         * Gets a value that determines whether the current stream can time out.
         * @access public
         * @return bool A value that determines whether the current stream can time out.
         */
        public function canTimeout()
        {
            // TODO: Implement canTimeout() method.
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports writing.
         * @access public
         * @return bool true if the stream supports writing; otherwise, false.
         */
        public function canWrite()
        {
            // TODO: Implement canWrite() method.
        }

        /**
         * When overridden in a derived class, clears all buffers for this stream and causes any buffered data to be written to the underlying device.
         * @access public
         * @throws IOException
         * @return void
         */
        public function flush()
        {
            // TODO: Implement flush() method.
        }

        /**
         * When overridden in a derived class, gets the length in bytes of the stream.
         * @access public
         * @return float A long value representing the length of the stream in bytes.
         */
        public function length()
        {
            // TODO: Implement length() method.
        }

        /**
         * When overridden in a derived class, gets or sets the position within the current stream.
         * @access public
         * @param int $value Set the position
         * @return The current position within the stream.
         */
        public function position($value = null)
        {
            // TODO: Implement position() method.
        }

        /**
         * When overridden in a derived class, reads a sequence of bytes from the current stream and advances the position within the stream by the number of bytes read.
         * @access public
         * @throws ArgumentException|ArgumentNullException|ArgumentOutOfRangeException|IOException|NotSupportedException|ObjectDisposedException
         * @param array $buffer An array of bytes. When this method returns, the buffer contains the specified byte array with the values between offset and (offset + count - 1) replaced by the bytes read from the current source.
         * @param int $offset The zero-based byte offset in buffer at which to begin storing the data read from the current stream.
         * @param int $count The maximum number of bytes to be read from the current stream.
         * @return int The total number of bytes read into the buffer. This can be less than the number of bytes requested if that many bytes are not currently available, or zero (0) if the end of the stream has been reached.
         */
        public function read(&$buffer, $offset, $count)
        {
            // TODO: Implement read() method.
        }

        /**
         * Reads a byte from the stream and advances the position within the stream by one byte, or returns -1 if at the end of the stream.
         * @access public
         * @return int The unsigned byte cast to an Int32, or -1 if at the end of the stream.
         */
        public function readByte()
        {
            // TODO: Implement readByte() method.
        }

        /**
         * When overridden in a derived class, sets the position within the current stream.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param float $offset A byte offset relative to the origin parameter.
         * @param string $origin A value of type SeekOrigin indicating the reference point used to obtain the new position.
         * @return float The new position within the current stream.
         */
        public function seek($offset, $origin)
        {
            // TODO: Implement seek() method.
        }

        /**
         * When overridden in a derived class, sets the length of the current stream.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param int $value The desired length of the current stream in bytes.
         * @return void
         */
        public function setLength($value)
        {
            // TODO: Implement setLength() method.
        }

        /**
         * Writes the stream contents to a byte array, regardless of the Position property.
         * @access public
         * @return array A new byte array.
         */
        public function toArray()
        {
            // TODO: Implement toArray() method.
        }

        /**
         * When overridden in a derived class, writes a sequence of bytes to the current stream and advances the current position within this stream by the number of bytes written.
         * @access public
         * @param array $array An array of bytes. This method copies count bytes from buffer to the current stream.
         * @param int $offset The zero-based byte offset in buffer at which to begin copying bytes to the current stream.
         * @param int $count The number of bytes to be written to the current stream.
         * @return void
         */
        public function write($array, $offset, $count)
        {
            // TODO: Implement write() method.
        }

        /**
         * Writes a byte to the current position in the stream and advances the position within the stream by one byte.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param $value The byte to write to the stream.
         * @return void
         */
        public function writeByte($value)
        {
            // TODO: Implement writeByte() method.
        }
    }
}