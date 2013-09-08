<?php

namespace System\IO {


    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\ObjectDisposedException as ObjectDisposedException;
    use \System\ArgumentException as ArgumentException;
    use \System\NotSupportedException as NotSupportedException;
    use \System\IO\Stream as Stream;

    /**
     * Creates a stream whose backing store is memory.
     *
     * @access public
     * @name MemoryStream
     * @package System
     * @subpackage IO
     */
    class MemoryStream extends Stream {

        private $memory = array();
        private $writable = true;
        private $capacity = 0;
        private $position = 0;

        /**
         * Initializes a new non-resizable instance of the System.IO.MemoryStream class based on the specified
         * region of a byte array, with the System.IO.MemoryStream.CanWrite property set as specified.
         *
         * @access public
         * @throws \System\ArgumentException The sum of index and count is greater than the length of buffer.
         * @throws \System\ArgumentNullException buffer is null.
         * @throws \System\ArgumentOutOfRangeException index or count are negative.
         * @param array $buffer The array of unsigned bytes from which to create this stream.
         * @param int $index The index in buffer at which the stream begins.
         * @param int $count The length of the stream in bytes.
         * @param bool $writable The setting of the System.IO.MemoryStream.CanWrite property, which determines whether the stream supports writing.
         */
        public function __construct($buffer=array(), $index=0, $count=null, $writable=true)
        {
            if(is_null($buffer))
            {
                throw new ArgumentNullException("buffer is null.");
            }

            if($index < 0 || $count < 0)
            {
                throw new ArgumentOutOfRangeException("index or count are negative.");
            }

            $this->createMemory($buffer, $index, $count);
            $this->writable = $writable;
        }

        private function createMemory($buffer, $index, $count)
        {
            $count = is_null($count) ? sizeof($buffer) - $index : $count;

            if(($index + $count) > sizeof($buffer))
            {
                throw new ArgumentException("The sum of index and count is greater than the length of buffer.");
            }

            $this->memory = array_slice($buffer, $index, $count);
            $this->capacity = isset($this->memory) ? sizeof($this->memory) : 0;
        }

        /**
         * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
         *
         * @access public
         * @return void
         */
        public function dispose() {
            unset($this->memory);
        }

        /**
         * Gets a value indicating whether the current stream supports reading.
         *
         * @access public
         * @return bool true if the stream supports reading; otherwise, false.
         */
        public function canRead() {
            return isset($this->memory);
        }

        /**
         * Gets a value indicating whether the current stream supports seeking.
         *
         * @access public
         * @return bool true if the stream supports seeking; otherwise, false.
         */
        public function canSeek() {
            return isset($this->memory);
        }

        /**
         * Gets a value that determines whether the current stream can time out.
         *
         * @access public
         * @return bool A value that determines whether the current stream can time out.
         */
        public function canTimeout() {
            return false;
        }

        /**
         * Gets a value indicating whether the current stream supports writing.
         *
         * @access public
         * @return bool true if the stream supports writing; otherwise, false.
         */
        public function canWrite() {
            return $this->writable && isset($this->memory);
        }


        /**
         * Gets or sets the number of bytes allocated for this stream.
         *
         * @access public
         * @param int $value number of bytes
         * @return int The length of the usable portion of the buffer for the stream.
         */
        public function capacity($value=null) {
            if(!is_null($value)) {
                $this->capacity = $value;
                $this->memory = array_slice($this->memory, 0, $this->capacity);
            }
            return $this->capacity;
        }

        /**
         * Overrides Stream.Flush so that no action is performed.
         *
         * @access public
         * @return void
         */
        public function flush() {
            return;
        }

        /**
         * Gets the length of the stream in bytes.
         *
         * @access public
         * @return float A long value representing the length of the stream in bytes.
         */
        public function length() {
            return sizeof($this->memory);
        }

        /**
         * Gets or sets the current position within the stream.
         *
         * @access public
         * @throws \System\ArgumentOutOfRangeException The position is set to a negative value or a value greater than MaxValue.
         * @throws \System\ObjectDisposedException The stream is closed.
         * @param int $value Set the position
         * @return The current position within the stream.
         */
        public function position($value = null) {

            if(!$this->canSeek()) {
                throw new ObjectDisposedException("The stream does not support seeking.");
            }

            if(!is_null($value)) {
                if($value < 0) throw new ArgumentOutOfRangeException("Attempted to set the position to a negative value.");
                $this->position = $value;
           }
           return $this->position;
        }

        /**
         * Reads a block of bytes from the current stream and writes the data to buffer.
         *
         * @access public
         * @throws \System\ArgumentException offset subtracted from the buffer length is less than count.
         * @throws \System\ArgumentOutOfRangeException offset or count is negative.
         * @throws \System\ObjectDisposedException The current stream instance is closed.
         * @param int $offset The zero-based byte offset in buffer at which to begin storing the data read from the current stream.
         * @param int $count The maximum number of bytes to be read from the current stream.
         * @return array The bytes written into the buffer.
         */
        public function read($offset=0, $count=null) {

            $this->assertOpened();

            if($offset < 0 || $count < 0) {
                throw new ArgumentOutOfRangeException("offset or count is negative.");
            }

            return array_slice($this->memory, $offset, $count);
        }

        /**
         * Reads a byte from the stream and advances the position within the stream by one byte, or returns -1 if at the end of the stream.
         *
         * @access public
         * @throws \System\ObjectDisposedException The current stream instance is closed.
         * @return int The unsigned byte cast to an Int32, or -1 if at the end of the stream.
         */
        public function readByte() {
            $this->assertOpened();
            return $this->memory[$this->position++];
        }

        /**
         * Sets the position within the current stream to the specified value.
         *
         * @access public
         * @throws \System\IO\IOException Seeking is attempted before the beginning of the stream.
         * @throws \System\ArgumentException There is an invalid SeekOrigin.
         * @throws \System\ObjectDisposedException The current stream instance is closed.
         * @param float $offset A byte offset relative to the origin parameter.
         * @param int $origin A value of type SeekOrigin indicating the reference point used to obtain the new position.
         * @return float The new position within the current stream.
         */
        public function seek($offset, $origin=null) {
            $this->assertOpened();

            if ($offset > sizeof($this->memory) || $offset < 0) {
                throw new IOException("Seeking is attempted before the beginning of the stream.");
            }

            if (is_null($origin)) {
                $origin = SeekOrigin::begin();
            }

            if (!$origin instanceof SeekOrigin) {
                throw new ArgumentException("There is an invalid SeekOrigin.");
            }


            if($origin == SeekOrigin::begin()) {
                $this->position($offset);
            }
            else if($origin == SeekOrigin::current()) {
                $this->position($offset + $this->position());
            }
            else {
                $this->position($this->length() - $offset);
            }
        }

        /**
         * Sets the length of the current stream to the specified value.
         *
         * @access public
         * @throws \System\NotSupportedException The current stream is not resizable and value is larger than the current capacity. -or- The current stream does not support writing.
         * @throws \System\ArgumentOutOfRangeException value is negative or is greater than the maximum length of the MemoryStream.
         * @param int $value The desired length of the current stream in bytes.
         * @return void
         */
        public function setLength($value) {

            if($value < 0) {
                throw new ArgumentOutOfRangeException("The current stream is not resizable and value is larger than the current capacity. -or- The current stream does not support writing.");
            }

            if(!$this->canWrite() || $value > $this->length()) {
                throw new NotSupportedException("value is negative or is greater than the maximum length of the MemoryStream, where the maximum length is(MaxValue - origin), and origin is the index into the underlying buffer at which the stream starts.");
            }

            $this->memory = array_slice($this->memory, 0, $value);
            $this->position(0);
        }

         /**
         * Writes the stream contents to a byte array, regardless of the Position property.
         *
         * @access public
         * @return array A new byte array.
         */
        public function toArray() {
            if(!$this->canRead()) {
                return array();
            }
            return $this->memory;
        }

        /**
         * Writes a block of bytes to the current stream using data read from buffer.
         *
         * @access public
         * @throws \System\ArgumentNullException buffer is null.
         * @throws \System\NotSupportedException The stream does not support writing.
         * @throws \System\ArgumentException offset subtracted from the buffer length is less than count.
         * @throws \System\ArgumentOutOfRangeException offset or count are negative.
         * @throws \System\IO\IOException An I/O error occurs.
         * @throws \System\ObjectDisposedException The current stream instance is closed.
         * @param array $buffer An array of bytes. This method copies count bytes from buffer to the current stream.
         * @param int $offset The zero-based byte offset in buffer at which to begin copying bytes to the current stream.
         * @param int $count The number of bytes to be written to the current stream.
         * @return void
         */
        public function write($buffer, $offset=0, $count=null) {

            if(is_null($buffer)) {
                throw new ArgumentNullException("buffer is null.");
            }

            $count = is_null($count) ? sizeof($buffer) - $offset : $count;
            $area = $offset + $count;

            if ($area > sizeof($buffer)) {
                throw new ArgumentException("offset subtracted from the buffer length is less than count.");
            }

            if ($offset < 0 || $count < 0) {
                throw new ArgumentOutOfRangeException("offset or count are negative.");
            }

            while(($offset < $area) && $this->position() <= $this->length()) {
                $this->writeByte($buffer[$offset]);
                $offset++;
            }
        }

        /**
         * Writes a byte to the current position in the stream and advances the position within the stream by one byte.
         *
         * @access public
         * @throws \System\NotSupportedException The stream does not support writing.
         * @throws \System\ObjectDisposedException The current stream instance is closed.
         * @param $value The byte to write to the stream.
         * @return void
         */
        public function writeByte($value) {
            $this->assertOpened();
            $this->assertWrite();
            $this->memory[$this->position++] = $value;
        }


        /**
         * Writes the entire contents of this memory stream to another stream.
         *
         * @access public
         * @throws \System\ObjectDisposedException The current or target stream is closed.
         * @param \System\IO\Stream $stream The stream to write this memory stream to.
         * @return void
        */
        public function writeTo(Stream $stream) {
            $this->assertOpened();
            $this->assertWrite();

            $position = $this->position();
            $this->seek(0);
            $stream->write($this->read());
            $this->seek($position);
        }


        /***********************
            ASSERT METHODS
        ***********************/
        private function assertOpened() {
            if(!isset($this->memory)) {
                throw new ObjectDisposedException("The current stream is closed.");
            }
        }

        private function assertWrite() {
            if(!$this->canWrite()) {
                throw new NotSupportedException("The stream does not support writing.");
            }
        }

    }
}
